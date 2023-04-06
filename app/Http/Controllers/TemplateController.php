<?php

namespace App\Http\Controllers;

use App\Models\Field;
use App\Models\Template;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class TemplateController extends Controller
{

    public function index()
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

    public function create()
    {
        return Inertia::render('Templates/Create');
    }

    public function edit($id)
    {
        $template = Template::with('fields')->findOrFail($id);
        return Inertia::render('Templates/Edit', ['template' => $template]);
    }

    public function update(Request $request, $id)
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


    public function massEdit()
    {
        $templates = Template::with('fields')->get();
        return Inertia::render('Templates/MassEdit', ['templates' => $templates]);
    }

    public function massUpdate(Request $request)
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


    public function store(Request $request)
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

}
