<?php

namespace App\Http\Controllers;

use App\Http\Resources\DocumentResource;
use App\Traits\DocumentTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class DocumentController extends Controller
{
    use DocumentTrait;

    public function show(Request $request): \Inertia\Response
    {

        $templates = config('templates');
        $categories = config('categories');

        $values = [
            'name' => $request->input('name'),
            'language' => $request->input('language'),
            'variants' => $request->input('variants', 1),
            'creativity' => $request->input('creativity', 'original'),
            'type' => $request->input('type', 'summarize'),
        ];

        foreach ($templates as $key => $value) {
            if ($value['single_input']) {
                $values[$key . '_input'] = $request->input($key . '_input');
            } else {
                foreach ($value['inputs'] as $k => $v) {
                    $values[$k] = $request->input($k);
                }
            }
        }

        $data = (object)[
            'values' => $values,
            'templates' => $templates,
            'categories' => $categories,
            'creativity_levels' => config('completions.creativity_levels'),
            'variations' => config('completions.variations'),
            'tones' => config('completions.tones'),
            'languages' => config('completions.languages'),
        ];

        Log::info("", (array)$data);

        return Inertia::render('Documents/Show', compact('data'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string',
            'type' => 'required|string',
        ]);

        $templates = config('templates');
        $categories = config('categories');

        $language = "en"; //mb_strtolower(config('languages')[$request->input('language')]['iso']);

        // TODO: validate max words

        $input = null;
        $prompt = "Write an answer in {$language}. What is love ";
/*
        if ($templates[$request->input('type')]['single_input']) {
            $input = $request->input($request->input('type') . '_input');
            $prompt .= sprintf($templates[$request->input('type')]['prompt'], $input);
        } else {
            $inputs = [];
            foreach ($templates[$request->input('type')]['inputs'] as $key => $value) {
                $inputs[$key] = $request->input($key);
            }

            $prompt .= vsprintf($templates[$request->input('type')]['prompt'], array_values($inputs));
            $input = json_encode($inputs);
        }*/

        try {
            $created = $this->generateContent($request, $prompt);//$this->storeDocument($request, $prompt);
            if ($created) {
                Log::info($created);
                return json_encode($created);
                //return DocumentResource::make($created);
            }
        } catch (\Exception $e) {
            Log::error("Documents store error:  {$e}");
            return response()->json([
                'message' => __('An unexpected error has occurred, please try again.'),
                'status' => 500
            ], 500);
        }

        return response()->json([
            'message' => __('Resource not found.'),
            'status' => 404
        ], 404);

    }

    public function update()
    {

    }

    public function delete()
    {

    }

}
