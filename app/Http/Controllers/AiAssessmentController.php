<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AssessmentSession;
use App\Models\AssessmentQuestion;
use App\Models\AssessmentAnswer;
use App\Models\CareerRecommendation;
use App\Services\GeminiService;
use Illuminate\Support\Facades\Log;

class AiAssessmentController extends Controller
{
    protected $aiService;

    public function __construct(GeminiService $aiService)
    {
        $this->aiService = $aiService;
    }

    public function index()
    {
        $user = auth()->user();

        // Fetch active session or create a new one
        $session = AssessmentSession::firstOrCreate(
            ['student_id' => $user->id, 'status' => 'in_progress'],
            ['confidence_score' => 0]
        );

        // Preload conversation history to render on initial generic page load
        $session->load('questions.answer');

        return view('student.ai.chat', compact('session'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'session_id' => 'required|exists:assessment_sessions,id',
            'answer_text' => 'nullable|string', // nullable for the immediate initial ping
            'question_id' => 'nullable|exists:assessment_questions,id'
        ]);

        $session = AssessmentSession::findOrFail($request->session_id);

        if ($session->status !== 'in_progress') {
            return response()->json(['error' => 'This assessment is already completed.'], 400);
        }

        // If the user actually submitted an answer to an existing question 
        if ($request->has('answer_text') && $request->has('question_id')) {
            AssessmentAnswer::create([
                'question_id' => $request->question_id,
                'answer_text' => $request->answer_text
            ]);
        }

        try {
            // Hit the OpenAIService cleanly with the current context chain
            $aiResponse = $this->aiService->generateQuestion($session);

            // Is it the final JSON block representing completion?
            if (isset($aiResponse['field_of_study'])) {

                // Store the recommendation formally parsed out
                $recommendation = CareerRecommendation::create([
                    'session_id' => $session->id,
                    'student_id' => $session->student_id,
                    'field_of_study' => $aiResponse['field_of_study'],
                    'recommended_course' => $aiResponse['recommended_course'],
                    'alternative_courses' => $aiResponse['alternative_courses'] ?? [],
                    'recommended_careers' => $aiResponse['recommended_careers'] ?? [],
                    'strengths' => $aiResponse['strengths'] ?? [],
                    'weaknesses' => $aiResponse['weaknesses'] ?? [],
                    'reasoning' => $aiResponse['reasoning'] ?? 'Based on assessment.',
                    'confidence_score' => $aiResponse['confidence_score'] ?? 100,
                ]);

                // Mark session as complete
                $session->update([
                    'status' => 'completed',
                    'confidence_score' => $aiResponse['confidence_score'] ?? 100
                ]);

                return response()->json([
                    'status' => 'completed',
                    'recommendation' => $recommendation
                ]);
            }

            // Otherwise, its continuing to interrogate -> save the new generated question!
            if (isset($aiResponse['question'])) {
                $questionText = $aiResponse['question'];
            } else {
                // Formatting fallback in case it generated straight text despite JSON rules
                $questionText = is_string($aiResponse) ? $aiResponse : json_encode($aiResponse);
            }

            $question = AssessmentQuestion::create([
                'session_id' => $session->id,
                'question_text' => $questionText
            ]);

            return response()->json([
                'status' => 'in_progress',
                'question' => $question
            ]);

        } catch (\Exception $e) {
            Log::error('AI Assessment Error: ' . $e->getMessage());
            return response()->json(['error' => 'Our AI Career Counselor encountered a processing error. Please try again.'], 500);
        }
    }
}
