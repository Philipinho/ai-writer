<?php

namespace App\Http\Controllers;

use App\Models\Field;
use App\Models\Template;
use Illuminate\Http\Request;
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
            ->select('uuid', 'name', 'key', 'description', 'icon', 'category_id')
            ->get();

        return Inertia::render('Templates/Index', ['templates' => $templates]);
    }

    public function delete()
    {

    }

    public function list()
    {
        $templates = Template::with('fields')->get();
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
        return Inertia::render('Templates/MassEdit', ['templates' => $templates]);
    }

    public function massUpdate(Request $request): \Illuminate\Http\JsonResponse
    {
        Log::info($request->input('templates'));
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
            'fields' => 'required|array',
            'fields.*.label' => 'required|string',
            'fields.*.optional' => 'required|boolean',
            'fields.*.name' => 'required|string',
            'fields.*.placeholder' => 'nullable|string',
            'fields.*.type' => 'required|string',
            'fields.*.maxLength' => 'nullable|integer',
        ]);

        $template = Template::create(['name' => $request->input('name'), 'key' => 'key_here', 'order' => 1]);

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

        foreach ($records as $record) {
            $template_key = Str::slug($record['template_key'], '_') ?? Str::slug($record['template_name'], '_');

            $templateData = [
                'key' => $template_key,
                'name' => $record['template_name'],
                'description' => $record['description'],
                'tones' => filter_var($record['tones'], FILTER_VALIDATE_BOOLEAN),
                'order' => $record['order'],
                //'category' => [$record['group_name']],
            ];

            $template = Template::updateOrCreate(['key' => $template_key], $templateData);

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
                        //'minLength' => $record["field{$fieldIndex}_minLength"],
                        'maxLength' => $record["field{$fieldIndex}_maxLength"],
                    ];

                    // Find the field by its name and the template_id.
                    $existingField = Field::where('name', $record["field{$fieldIndex}_name"])->where('template_id', $template->id)->first();

                    // If the field exists, update it. Otherwise, create a new field.
                    if ($existingField) {
                        $existingField->update($fieldData);
                    } else {
                        $template->fields()->create($fieldData);
                    }
                }

                $fieldIndex++;
            }
        }
    }

}
