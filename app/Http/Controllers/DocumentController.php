<?php

namespace App\Http\Controllers;

use App\Http\Resources\DocumentResource;
use App\Models\Document;
use App\Traits\DocumentTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use function GuzzleHttp\Promise\all;

class DocumentController extends Controller
{
    use DocumentTrait;

    public function show(Request $request): \Inertia\Response
    {

        $categories = config('categories');

        $values = [
            'name' => $request->input('name'),
            'template' => $request->input('template'),
            'language' => $request->input('language'),
            'variants' => $request->input('variants', 1),
            'creativity' => $request->input('creativity', 'original'),
        ];

        $templates = json_decode(Storage::get('templates.json'));

        $data = (object)[
            'values' => $values,
            // 'templates' => $templates,
            'categories' => $categories,
            'creativity_levels' => config('completions.creativity_levels'),
            'variations' => config('completions.variations'),
            'tones' => config('completions.tones'),
            'languages' => config('completions.languages'),
        ];

        Log::info("", (array)$data);

        return Inertia::render('Documents/Show', compact('data', 'templates'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string',
            'type' => 'required|string',
        ]);

        $templates = json_decode(Storage::get('templates.json'));
        $categories = config('categories');

        $language = $request->input('language');

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
            $created = $this->getContent($request, $prompt);//$this->storeDocument($request, $prompt);
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

    public function createDocument(Request $request)
    {
        //get the template key
        $template = $request->input('template');
        Log::info($template);

        $doc = Document::create([
            'user_id' => auth()->user()->id,
            'name' => now() . " untitled",
            'content' => 'Hurray!',
            'template_key' => $template,
            // 'template_id' => $template,
            'status' => 1,
        ]);

        if ($doc) {
            return to_route('document.edit', $doc->uuid);
        }

        return "error";
    }

    public function editDocument(Request $request, $uuid): \Inertia\Response
    {

        //$template = $request->input('template');

        $document = Document::where('uuid', $uuid)
            ->where('user_id', auth()->user()->id)
            ->firstOrFail(); // or redirect the user to homepage

        $categories = config('categories');

        $values = [
            'name' => $document->name,
            'content' => $document->content,
            'template' => $document->template_key,
            'language' => $request->input('language'), // preserve?
            'variants' => $request->input('variants', 1),
            'creativity' => $request->input('creativity', 'original'), // preserve?
        ];

        $templates = json_decode(Storage::get('templates.json'));

        $data = (object)[
            'values' => $values,
            // 'templates' => $templates,
            'categories' => $categories,
            'creativity_levels' => config('completions.creativity_levels'),
            'variations' => config('completions.variations'),
            'tones' => config('completions.tones'),
            'languages' => config('completions.languages'),
        ];

        Log::info("", (array)$data);

        return Inertia::render('Documents/Show', compact('data', 'templates'));
    }

    public function updateDocument($uuid)
    {
        $document = Document::where('uuid', $uuid)
            ->where('user_id', auth()->user()->id)
            ->firstOrFail();

        $document->update([
            'name' => '',
            'content' => '',
            'word_count' => '',
            'template_key' => ''
        ]);

        return response()->json(['success' => true]);
    }

    public function generateContent(Request $request, $prompt)
    {
        //call the openai for the template with prompt
        // store the content of the api response inside the document_content table with relationships with documents table
        // update word count of the document
        // return json response of the open api single response and multi response array

        // append editor with the recent content
        // give user choice to decide whether to auto append new generation or
        // to give them the choice to add or discard response
        // with the later option, the reponses will be added below the prompt form

    }

    public function delete()
    {

    }

}
