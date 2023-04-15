<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Document;
use App\Models\DocumentContent;
use App\Models\Template;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Orhanerday\OpenAi\OpenAi;

class DocumentController extends Controller
{

    public function index(): \Inertia\Response
    {

        $documents = auth()->user()->currentTeam->documents()
            ->with(['template' => function ($query) {
                $query->select('id', 'name');
            }])
            ->select('team_id', 'uuid', 'name', 'template_key', 'template_id', 'favorite', 'created_at', 'updated_at')
            ->orderBy('updated_at', 'DESC')
            ->paginate(15)
            ->withQueryString()
            ->through(function ($document) {
                return auth()->user()->can('view', $document) ? $document : null;
            });

        return Inertia::render('Documents/Index', ['documents' => $documents]);
    }

    public function contentHistory(): \Inertia\Response
    {

        $contents = auth()->user()->currentTeam->documentContents()
            ->with(['template' => function ($query) {
                $query->select('id', 'name');
            }])
            ->with(['document' => function ($query) {
                $query->select('id', 'uuid', 'name');
            }])
            ->select('team_id', 'uuid', 'document_id', 'template_id', 'content', 'word_count', 'favorite', 'created_at', 'updated_at')
            ->orderBy('updated_at', 'DESC')
            ->paginate(10)
            ->withQueryString()
            ->through(function ($content) {
                return $content;
            });

        Log::info($contents);

        return Inertia::render('Documents/History', ['contents' => $contents]);
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

        return Inertia::render('Documents/Edit', compact('data', 'templates'));
    }

    public function createDocument(Request $request)
    {
        // Check if the user is authorized to create a document
        if (!Gate::allows('create', Document::class)) {
            return response("Unauthorized", 403);
        }

        // Get the template key
        $template = $request->input('template');

        $template_id = optional(Template::where('key', $template)->first())->id;

        // Create the document
        $doc = Document::create([
            'user_id' => auth()->user()->id,
            'team_id' => auth()->user()->currentTeam->id,
            'name' => now() . " untitled",
            'template_id' => $template_id,
            'template_key' => $template,
            'status' => 1,
        ]);

        if ($doc) {
            return redirect()->route('documents.edit', $doc->uuid);
        }

        return response("error", 500);
    }

    public function editDocument(Request $request, $uuid): \Illuminate\Http\RedirectResponse|\Inertia\Response
    {
        $document = Document::where('uuid', $uuid)
            ->where('team_id', auth()->user()->currentTeam->id)
            ->firstOrFail();

        //$categories = Category::select('name')->get();

        $values = [
            'uuid' => $uuid,
            'name' => $document->name,
            'content' => $document->content,
            'template' => $document->template_key,
            'language' => $request->input('language'), // preserve?
            'variants' => $request->input('variants', 1),
            'creativity' => $request->input('creativity', 'original'), // preserve?
        ];

        $templates = Template::with('fields')->with(['categories' => function ($query) {
            $query->select('name');
        }])->get();

        $data = (object)[
            'values' => $values,
            //'categories' => $categories,
            'creativity_levels' => config('completions.creativity_levels'),
            'variations' => config('completions.variations'),
            'tones' => config('completions.tones'),
            'languages' => config('completions.languages'),
        ];

        return Inertia::render('Documents/Edit', compact('data', 'templates'));
    }

    public function updateDocument($uuid, Request $request): \Illuminate\Http\JsonResponse
    {
        $document = Document::where('uuid', $uuid)
            ->where('team_id', auth()->user()->currentTeam->id)
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
            $document->content = $content;
        }

        if ($action === 'update_name') {
            $name = $request->input('name');
            $document->name = $name;
        }

        $document->save();

        return response()->json(['success' => true]);
    }

    public function generate(Request $request, $uuid)
    {
        $team = auth()->user()->currentTeam;

        if (!auth()->user()->can('creditCheck', $team)) {
            return response()->json(['success' => false, 'message' => 'Sorry, you have exhausted your credits. Please upgrade your plan.'], 429);
        }

        //Todo: validate fields
        $document = Document::where('uuid', $uuid)
            ->where('team_id', $team->id)
            ->firstOrFail();

        $template_key = $request->input('template');
        $template_id = optional(Template::where('key', $template_key)->first())->id;

        $tone = $request->input('tone');
        $language = $request->input('language');

        $template_data = Template::where('key', $template_key)->first();

        $inputLabelsData = $request->input('inputLabels');
        $inputArrays = [];

        foreach ($inputLabelsData as $key => $value) {
            $inputArrays[$key] = $value;
        }

        $full_prompt = __($template_data->prompt, $inputArrays);

        if (!empty($tone)){
            $full_prompt .= "\nYour response should be in a " . $tone . " tone.";
        }
        $full_prompt .= "\nIt should be in " . $language . " language.";

        Log::info($full_prompt);

        $response = $this->getCompletions($request, $full_prompt);

        $completion = $response['choices'][0]['message']['content'];
        $wordCount = $this->getWordCount($completion);

        // store the document content, attach it to the main document.
        $document_content = DocumentContent::create([
            'content' => nl2br($completion), // TODO: fix editor line breaks
            'word_count' => $wordCount,
            'prompt' => $full_prompt,
            'metadata' => json_encode($request->all()),
            'user_id' => auth()->user()->id,
            'team_id' => auth()->user()->currentTeam->id,
            'document_id' => $document->id,
            'template_id' => $template_id,
            'template_key' => $template_key,
        ]);

        $document->template_id = $template_id;
        $document->template_key = $template_key;
        $document->save();

        $team->teamCredits->deductCredits($wordCount);

        $document_content_uuid = $document_content->uuid;
        $document_content_array = $document_content->toArray();
        $document_content_array['uuid'] = $document_content_uuid->toString();

        return response()->json(['success' => true, 'data' => $document_content_array]);

        // return json response of the open api single response and multi response array

        // give user choice to decide whether to auto append new generation or
        // to give them the choice to add or discard response
        // with the later option, the responses will be added below the prompt form
    }

    public function delete($uuid): \Illuminate\Http\JsonResponse
    {
        $document = Document::where('uuid', $uuid)
            ->where('team_id', auth()->user()->currentTeam->id)
            ->firstOrFail();

        $document->delete();

        return response()->json(['success' => true, 'message' => 'deleted']);
    }

    protected function permissionsCheck(Document $document): ?\Illuminate\Http\JsonResponse
    {
        if (!$document || !auth()->user()->can('update', $document)) {
            return response()->json(['success' => false]);
        }
        return null;
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

    public function getWordCount($content): float|int
    {
        $words = array_filter(explode(' ', preg_replace('/[^\w]/ui', ' ', mb_strtolower(trim($content)))));
        $wordsCount = 0;
        foreach ($words as $word) {
            $wordsCount += $this->wordCount($word);
        }
        return round($wordsCount);
    }

    private function wordCount($word): float|int
    {
        foreach (config('completions.ratios') as $ratio) {
            if (preg_match('/\p{' . implode('}|\p{', $ratio['scripts']) . '}/u', $word)) {
                return mb_strlen($word) * $ratio['value'];
            }
        }
        return 1;
    }

}
