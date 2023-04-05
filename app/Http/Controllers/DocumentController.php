<?php

namespace App\Http\Controllers;

use App\Http\Resources\DocumentResource;
use App\Models\Document;
use App\Models\DocumentContent;
use App\Models\Template;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Orhanerday\OpenAi\OpenAi;

class DocumentController extends Controller
{

    public function index()
    {
        $documents = Document::where('user_id', auth()->user()->id)
            ->select('uuid', 'name', 'template_key', 'favorite','created_at','updated_at')
            ->get();

        return Inertia::render('Documents/Index', ['documents' => $documents]);
    }

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

    public function createDocument(Request $request)
    {
        //get the template key
        $template = $request->input('template');
        Log::info($template);

        $doc = Document::create([
            'user_id' => auth()->user()->id,
            'name' => now() . " untitled",
            //'content' => '',
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
            'uuid' => $uuid,
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

    public function updateDocument($uuid, Request $request)
    {
        $document = Document::where('uuid', $uuid)
            ->where('user_id', auth()->user()->id)
            ->firstOrFail();

        $action = $request->input('action');

        // Validate the request based on the action
        $request->validate([
            'action' => [
                'required',
                Rule::in(['update_content', 'update_name']),
            ],
            'content' => [
                'required_if:action,update_content',
                'string',
            ],
            'name' => [
                'required_if:action,update_name',
                'string',
            ],
        ]);

        if ($action === 'update_content') {
            $content = $request->input('content');
            $document->update(['content' => $content]);
        }

        if ($action === 'update_name') {
            $name = $request->input('name');
            $document->update(['name' => $name]);
        }

        return response()->json(['success' => true]);
    }

    public function generate(Request $request, $uuid)
    {
        //Todo: validate fields

        $document = Document::where('uuid', $uuid)
            ->where('user_id', auth()->user()->id)
            ->firstOrFail();

        $template_key = $request->input('template');
        $tone = $request->input('tone');
        $language = $request->input('language');

        $template_data = Template::where('key', $template_key)->first();

        Log::info("Prompt: ". $template_data->prompt);

        $inputLabelsData = $request->input('inputLabels');
        $inputArrays = [];

        foreach ($inputLabelsData as $key => $value) {
            $inputArrays[$key] = $value;
        }

        $full_prompt = __($template_data->prompt, $inputArrays);
        // Todo: add language option
        // append tone.

        Log::info($full_prompt);

        $response = $this->getCompletions($request, $full_prompt);

        $completion = $response['choices'][0]['message']['content'];
        // Log::info("message", $response);

        //$document->template_id = optional(Template::where('key', $template_key)->first())->id;

        // store the document content, attach it to the main document.
        $document_content = DocumentContent::create([
            'content' => $completion,
            'word_count' => $this->getWordCount($completion),
            'prompt' => $full_prompt,
            'metadata' => '',
            'user_id' => auth()->user()->id,
            'document_id' => $document->id,//Todo: store uuid
            //'template_id' => '', //store uuid
            'template_key' => $request->input('template'),
        ]);



        $document_content_uuid = $document_content->uuid;
        $document_content_array = $document_content->toArray();
        $document_content_array['uuid'] = $document_content_uuid->toString();

        return response()->json(['success' => true, 'data' => $document_content_array]);

        // store the content of the api response inside the document_content table with relationships with documents table
        // update word count of the document
        // return json response of the open api single response and multi response array

        // give user choice to decide whether to auto append new generation or
        // to give them the choice to add or discard response
        // with the later option, the responses will be added below the prompt form

    }

    public function delete($uuid)
    {
        $document = Document::where('uuid', $uuid)
            ->where('user_id', auth()->user()->id)
            ->firstOrFail();

        $document->delete();

        return response()->json(['success' => true, 'message' => 'deleted']);
    }

    public function getCompletions(Request $request, $prompt): array
    {
        $openAI = new OpenAi(config('openai.api_key'));

        $chat_completion = $openAI->chat([
            'model' => config('openai.model'),
            'messages' => [
                [
                    "role" => "system",
                    "content" => "You are a helpful assistant."
                ],
                [
                    'role' => 'user',
                    'content' => $prompt
                ]
            ],
            'temperature' => $request->has('creativity') ? (float)$request->input('creativity') : 0.5,
            'n' => $request->has('variations') ? (float)$request->input('variations') : 1.0,
            'max_tokens' => 2048,
            'frequency_penalty' => 0,
            'presence_penalty' => 0,
            'user' => 'user' . $request->user()->id
        ]);

        return json_decode($chat_completion, true);
    }


    public function getWordCount($content){
        $words = array_filter(explode(' ', preg_replace('/[^\w]/ui', ' ', mb_strtolower(trim($content)))));
        $wordsCount = 0;
        foreach ($words as $word) {
            $wordsCount += $this->wordCount($word);
        }
        return round($wordsCount);
    }

    private function wordCount($word)
    {
        foreach (config('completions.ratios') as $ratio) {
            if (preg_match('/\p{' . implode('}|\p{', $ratio['scripts']) . '}/u', $word)) {
                return mb_strlen($word) * $ratio['value'];
            }
        }
        return 1;
    }

}
