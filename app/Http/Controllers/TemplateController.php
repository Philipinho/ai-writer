<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Field;
use App\Models\Template;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Inertia\Inertia;
use League\Csv\Reader;
use League\Csv\Statement;

class TemplateController extends Controller
{

    public function index(): \Inertia\Response
    {
        $templates = Template::where('status', 1)
            ->with('categories:id,name')
           // ->select('uuid', 'name', 'key', 'description', 'icon')
            ->get();

        $categories = Category::has('templates')->get();

        return Inertia::render('Templates/Index', [
            'templates' => $templates,
            'categories' => $categories,
            ]);
    }

    public function list()
    {
        $templates = Template::with('fields')
            ->with(['categories' => function ($query) {
                $query->select('name');
            }])
            ->get();

        $templates->each(function ($template) {
            $template->makeVisible('prompt');
        });

        return Inertia::render('Templates/List', [
            'templates' => $templates,
        ]);
    }

    public function create(): \Inertia\Response
    {
        return Inertia::render('Templates/Create');
    }

    public function edit($id): \Inertia\Response
    {
        $template = Template::with('fields')->findOrFail($id);
        $template->makeVisible('prompt');
        return Inertia::render('Templates/Edit', ['template' => $template]);
    }

    public function update(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        $template = Template::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'fields' => 'required|array',
        ]);

        $template->update([
            'name' => $request->input('name'),
        ]);

        $newFields = collect($request->input('fields'))->map(function ($field) use ($template) {
            return new Field([
                'label' => $field['label'],
                'optional' => $field['optional'],
                'name' => $field['name'],
                'placeholder' => $field['placeholder'],
                'type' => $field['type'],
                'order' => $field['order'],
                'maxLength' => $field['maxLength'],
                'template_id' => $template->id,
            ]);
        });

        $template->fields()->delete();
        $template->fields()->saveMany($newFields);

        return response()->json([
            'status' => 'success',
            'message' => 'Skill updated successfully',
        ]);
    }


    public function massEdit(): \Inertia\Response
    {
        $templates = Template::with('fields')->get();
        $templates->each(function ($template) {
            $template->makeVisible('prompt');
        });
        return Inertia::render('Templates/MassEdit', ['templates' => $templates]);
    }

    public function massUpdate(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'templates' => 'required|array',
        ]);

        foreach ($request->input('templates') as $templateData) {
            $template = Template::findOrFail($templateData['id']);
            $template->update([
                'name' => $templateData['name'],
            ]);

            // Remove old fields
            $template->fields()->delete();

            // Add new fields
            $fields = collect($templateData['fields'])->map(function ($field) use ($template) {
                return new Field([
                    'label' => $field['label'],
                    'optional' => $field['optional'],
                    'name' => $field['name'],
                    'placeholder' => $field['placeholder'],
                    'type' => $field['type'],
                    'maxLength' => $field['maxLength'],
                    'template_id' => $template->id,
                ]);
            });

            $template->fields()->saveMany($fields);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Templates updated successfully',
        ]);
    }


    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'string',
            'prompt' => 'required|string',
            'icon' => 'string',
            'fields' => 'required|array',
            'fields.*.label' => 'required|string',
            'fields.*.optional' => 'required|boolean',
            'fields.*.name' => 'required|string',
            'fields.*.placeholder' => 'nullable|string',
            'fields.*.type' => 'required|string',
            'fields.*.maxLength' => 'nullable|integer',
        ]);

        $template = Template::create([
            'name' => $request->input('name'),
            'key' => Str::slug($request->input('name'), '_'),
            'description' => $request->input('description'),
            'prompt' => $request->input('prompt'),
            'icon' => $request->input('icon'),
            //'order' => 1
        ]);

        $fields = collect($request->input('fields'))->map(function ($field) use ($template) {
            return new Field([
                'label' => $field['label'],
                'optional' => $field['optional'],
                'name' => $field['name'],
                'placeholder' => $field['placeholder'],
                'type' => $field['type'],
                'maxLength' => $field['maxLength'],
                'order' => $field['order'],
                'template_id' => $template->id,
            ]);
        });

        $template->fields()->saveMany($fields);

        return response()->json([
            'status' => 'success',
            'message' => 'Template created successfully',
        ]);
    }

    public function import(): \Inertia\Response
    {
        return Inertia::render('Templates/Import');
    }

    public function importFile(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $request->validate([
                'file' => 'required|mimes:csv,txt,json',
            ]);

            $path = $request->file('file')->store('temp');
            $fullPath = Storage::path($path);
            //$extension = $request->file('file')->getClientOriginalExtension();

            $this->importCsv($fullPath);

            Storage::delete($path);

        } catch (\Exception $e) {

            return response()->json([
                'status' => 'failed',
                'message' => $e->getMessage(),
            ], 500);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Template created successfully',
        ]);
    }

    protected function importCsv($filePath)
    {
        $csv = Reader::createFromPath($filePath);
        $csv->setHeaderOffset(0);
        $records = (new Statement())->process($csv);

        DB::beginTransaction();

        try {
            foreach ($records as $record) {

                $template_key = Str::slug($record['template_key'], '_');
                if (empty($record['template_key'])){
                    $template_key = Str::slug($record['template_name'], '_');
                }

                $categoryKeys = array_map('trim', explode(',', $record['category_keys']));
                $categories = Category::whereIn('key', $categoryKeys)->get();
                $categoryIds = $categories->pluck('id')->toArray();

                if (empty($record['template_name'])) continue;

                $templateData = [
                    'key' => $template_key,
                    'name' => $record['template_name'],
                    'description' => $record['description'],
                    'prompt' => $record['prompt'],
                    'tones' => filter_var($record['tones'], FILTER_VALIDATE_BOOLEAN),
                    'icon' => $record['icon'],
                    'color' => $record['color'],
                    'order' => $record['order'],
                    'status' => $record['status'],
                ];

                $template = Template::updateOrCreate(['key' => $template_key], $templateData);
                $template->categories()->sync($categoryIds);

                $fieldIndex = 1;
                while (isset($record["field{$fieldIndex}_label"])) {
                    if (!empty($record["field{$fieldIndex}_label"])) {
                        $fieldData = [
                            'label' => $record["field{$fieldIndex}_label"],
                            'required' => filter_var($record["field{$fieldIndex}_required"], FILTER_VALIDATE_BOOLEAN),
                            'name' => $record["field{$fieldIndex}_name"],
                            'placeholder' => $record["field{$fieldIndex}_placeholder"],
                            'type' => $record["field{$fieldIndex}_type"],
                            'order' => $record["field{$fieldIndex}_order"],
                            'maxLength' => $record["field{$fieldIndex}_maxLength"],
                            'show' => filter_var($record["field{$fieldIndex}_show"], FILTER_VALIDATE_BOOLEAN),
                        ];

                        $existingField = Field::where('name', $record["field{$fieldIndex}_name"])->where('template_id', $template->id)->first();

                        if ($existingField) {
                            $existingField->update($fieldData);
                        } else {
                            $template->fields()->create($fieldData);
                        }
                    }

                    $fieldIndex++;
                }
            }

            DB::commit();
        } catch (\Exception $e) {
            Log::error($e);
            DB::rollback();
            throw $e;
        }
    }

}
