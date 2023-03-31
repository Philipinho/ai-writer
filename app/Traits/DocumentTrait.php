<?php

namespace App\Traits;

use App\Models\Document;
use App\Models\Template;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Orhanerday\OpenAi\OpenAi;

trait DocumentTrait
{

    protected function storeDocument(Request $request, string $prompt = null): Document
    {
        $response = $this->fetchCompletions($request, $prompt);
        $i = 1;
        $content = '';

        if (count($response['choices']) > 1) {
            foreach ($response['choices'] as $result) {
                $content .= $result['message']['content'] . PHP_EOL . PHP_EOL;
                $content .= "---------------------------------------" . PHP_EOL . PHP_EOL;
                $i++;
            }
        } else {
            $content = $response['choices'][0]['message']['content'];
        }

        return $this->documentModel($request, $content);
    }

    private function documentModel(Request $request, $content): Document
    {
        $text = $content;

        $words = array_filter(explode(' ', preg_replace('/[^\w]/ui', ' ', mb_strtolower(trim($text)))));

        $wordsCount = 0;
        foreach ($words as $word) {
            $wordsCount += $this->wordCount($word);
        }

        $wordsCount = round($wordsCount);

        $document = new Document;
        $document->uuid = Str::uuid();
        $document->name = $request->input('name');
        $document->user_id = $request->user()->id;
        $document->template_id = optional(Template::where('slug', $request->input('type'))->first())->id ?? 1;
        $document->content = trim($text);
        $document->words = $wordsCount;
        $document->save();

        $request->user()->documents_month_count += 1;
        $request->user()->documents_total_count += 1;
        $request->user()->words_month_count += $wordsCount;
        $request->user()->words_total_count += $wordsCount;
        $request->user()->save();

        return $document;
    }

    protected function updateDocument(Request $request, Document $document)
    {
        if ($request->has('name')) {
            $document->name = $request->input('name');
        }

        if ($request->has('favorite')) {
            $document->favorite = $request->input('favorite');
        }

        if ($request->has('content')) {
            $document->content = $request->input('content');
        }

        $document->save();

        return $document;
    }

    private function fetchCompletions(Request $request, $prompt)
    {
        $httpClient = new Client();

        $response = $httpClient->request('POST', 'https://api.openai.com/v1/chat/completions',
            [
                'timeout' => config('settings.request_timeout') * 60,
                'headers' => [
                    // 'User-Agent' => "",
                    'Authorization' => 'Bearer ' . config('openai.api_key'),
                ],
                'json' => [
                    'model' => config('openai.model'),
                    'messages' => [
                        [
                            'role' => 'user',
                            'content' => trim(preg_replace('/(?:\s{2,}+|[^\S ])/', ' ', $prompt))
                        ]
                    ],
                    'temperature' => $request->has('creativity') ? (float)$request->input('creativity') : 0.5,
                    'n' => $request->has('variations') ? (float)$request->input('variations') : 1,
                    'frequency_penalty' => 0,
                    'presence_penalty' => 0,
                    'user' => 'user' . $request->user()->id
                ]
            ]
        );

        return json_decode($response->getBody()->getContents(), true);
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

    public function generateContent(Request $request, $prompt)
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
            'max_tokens' => 2040,
            'frequency_penalty' => 0,
            'presence_penalty' => 0,
            'user' => 'user' . $request->user()->id
        ]);

        return json_decode($chat_completion);
    }
}
