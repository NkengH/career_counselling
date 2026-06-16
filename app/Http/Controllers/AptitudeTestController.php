<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AptitudeTest;
use App\Models\AptitudeQuestion;
use App\Models\AptitudeResult;
use App\Models\Recommendation;
use App\Services\AIRecommendationService;

class AptitudeTestController extends Controller
{
    protected $aiService;

    public function __construct(AIRecommendationService $aiService)
    {
        $this->aiService = $aiService;
    }

    public function index()
    {
        $user = auth()->user();
        $completedTestIds = AptitudeResult::where('student_id', $user->id)->pluck('aptitude_test_id')->toArray();
        $tests = AptitudeTest::whereNotIn('id', $completedTestIds)->get();
        return view('student.tests.index', compact('tests'));
    }

    public function show($id)
    {
        $test = AptitudeTest::with('questions')->findOrFail($id);
        return view('student.tests.show', compact('test'));
    }

    public function submit(Request $request, $id)
    {
        $user = auth()->user();
        $test = AptitudeTest::with('questions')->findOrFail($id);

        $scoresByCategory = [];
        $totalQuestionsByCategory = [];

        foreach ($test->questions as $question) {
            $cat = $question->category;
            if (!isset($scoresByCategory[$cat])) {
                $scoresByCategory[$cat] = 0;
                $totalQuestionsByCategory[$cat] = 0;
            }
            $totalQuestionsByCategory[$cat]++;

            $answer = $request->input('q_' . $question->id);
            if ($answer && $answer === $question->correct_answer) {
                $scoresByCategory[$cat]++;
            }
        }

        // Save Results mapped to categorical percentages
        foreach ($scoresByCategory as $category => $score) {
            $percentage = ($score / $totalQuestionsByCategory[$category]) * 100;
            AptitudeResult::create([
                'student_id' => $user->id,
                'aptitude_test_id' => $test->id,
                'category' => $category,
                'score' => $percentage
            ]);
        }

        // Trigger AI Recommendation Processing Pipeline
        $this->aiService->generateRecommendations($user);

        return redirect()->route('student.dashboard')->with('success', 'Test completed and logged. Your AI recommendation metrics have been successfully recalibrated!');
    }
}
