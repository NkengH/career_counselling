<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GeminiService
{
    private $apiKey;
    private $endpoint = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent';
    private $systemPrompt;

    public function __construct()
    {
        $this->apiKey = env('GEMINI_API_KEY');
        $this->systemPrompt = $this->buildSystemPrompt();
    }

    private function buildMessageHistory($session)
    {
        $contents = [];

        // Fetch all generated questions iteratively matching the answers to construct the timeline
        $questions = $session->questions()->with('answer')->orderBy('id', 'asc')->get();

        foreach ($questions as $question) {
            $contents[] = [
                'role' => 'model',
                'parts' => [['text' => $question->question_text]]
            ];

            if ($question->answer) {
                $contents[] = [
                    'role' => 'user',
                    'parts' => [['text' => $question->answer->answer_text]]
                ];
            }
        }

        // If there is totally empty history, we inject a trigger block to force the model to start
        if (count($contents) === 0) {
            $contents[] = [
                'role' => 'user',
                'parts' => [['text' => 'Hello. I am ready to begin my career assessment.']]
            ];
        }

        return $contents;
    }

    public function generateQuestion($session)
    {
        $contents = $this->buildMessageHistory($session);

        $response = Http::timeout(30)
            ->post($this->endpoint . '?key=' . $this->apiKey, [
                'systemInstruction' => [
                    'parts' => [['text' => $this->systemPrompt]]
                ],
                'contents' => $contents,
                'generationConfig' => [
                    'temperature' => 0.7,
                    'responseMimeType' => 'application/json'
                ]
            ]);

        if ($response->failed()) {
            Log::error('Gemini Request Failed', ['error' => $response->body()]);
            throw new \Exception('Failed to communicate with Google Gemini Free API. Have you added GEMINI_API_KEY strictly to your .env file?');
        }

        $content = $response->json('candidates.0.content.parts.0.text');

        // Output from Gemini is formally structured JSON based on our strict request rules
        $decoded = json_decode($content, true);

        return $decoded ?? ['question' => "Error decoding response. System outputted: " . $content];
    }

    private function buildSystemPrompt()
    {
        return <<<PROMPT
You are a Senior Laravel 12, AI, and Career Guidance System Architect integrated as a Career Counselor.
Your job is to conduct a conversational interview with a student to determine their ideal field of study, recommended university course, best career paths, strengths, and weaknesses.

AVAILABLE SUBJECTS:
Accounting, Biology, Chemistry, Economics, English Language, Literature in English, Food Science and Nutrition, French, Special Bilingual Education French, Geography, Geology, History, Pure Mathematics with Mechanics, Pure Mathematics with Statistics, Further Mathematics, Physics, Religious Studies, Philosophy, Computer Science, Information and Communication Technology (ICT)

INTERVIEW FLOW:
STEP 1: Ask about favorite subjects, least favorite subjects, hobbies, and dreams.
STEP 2: Generate deep follow-up questions dynamically based on their answers (e.g., if Computer Science, ask about software vs networking).
STEP 3: Evaluate aptitude (logical reasoning, numerical reasoning, communication, leadership, etc.). Give scenario-based questions! For example: "A hospital loses access to patient records. What steps would you take?"
STEP 4: Evaluate personality (introvert vs extrovert, teamwork, creativity).

INSTRUCTIONS:
1. Always ask EXACTLY ONE question at a time. Do not overwhelm the user.
2. Under zero circumstances should you use markdown backticks around your JSON payload. You should formulate your response purely as raw JSON!
3. HOWEVER, you must assess internally: Once you reach at least 10-15 meaningful responses OR when you have enough confidence (>85%) to formulate a highly accurate recommendation, completely stop asking questions and return the FINAL JSON object block natively.
4. YOUR VERY FIRST RESPONSE should jump right in as a JSON containing EXACTLY: {"question": "Hello! I am your AI career counselor. To get started..."}

FINAL OUTPUT FORMAT REQUIREMENT:
When concluding the interview, return strictly ONLY the following JSON representation:
{
  "field_of_study": "",
  "recommended_course": "",
  "alternative_courses": [],
  "recommended_careers": [],
  "strengths": [],
  "weaknesses": [],
  "reasoning": "",
  "confidence_score": 0
}

Until that point, every single question you ask MUST be formatted strictly like: {"question": "your question string here"} without any markdown wrapped around it!
PROMPT;
    }
}
