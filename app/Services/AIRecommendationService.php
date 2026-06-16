<?php

namespace App\Services;

use App\Models\User;
use App\Models\AptitudeResult;
use App\Models\Career;
use App\Models\Recommendation;

class AIRecommendationService
{
    /**
     * Generate career recommendations for a student based on aptitude results.
     */
    public function generateRecommendations(User $student)
    {
        $results = AptitudeResult::where('student_id', $student->id)->get();
        if ($results->isEmpty()) {
            return false;
        }

        $scores = $results->pluck('score', 'category')->toArray();

        $mathScore = $scores['Mathematics'] ?? 0;
        $logicScore = $scores['Logical Reasoning'] ?? 0;
        $bioScore = $scores['Biology'] ?? 0;

        $recommendedCareers = [];

        if ($mathScore > 80 && $logicScore > 75) {
            $recommendedCareers[] = [
                'name' => ['Computer Science', 'Software Engineering', 'Data Science'],
                'explanation' => 'High scores in Mathematics and Logical Reasoning indicate strong potential in computing and analytical fields.',
                'score' => min(100, ($mathScore + $logicScore) / 2 + 10)
            ];
        }

        if ($bioScore > 80) {
            $recommendedCareers[] = [
                'name' => ['Medicine', 'Nursing', 'Medical Laboratory Science'],
                'explanation' => 'A high biology score strongly correlates with success in medical and life science careers.',
                'score' => min(100, $bioScore + 5)
            ];
        }

        if (empty($recommendedCareers)) {
            $average = count($scores) > 0 ? array_sum($scores) / count($scores) : 0;
            $recommendedCareers[] = [
                'name' => ['Business Administration', 'General Arts', 'Social Sciences'],
                'explanation' => 'Based on your balanced profile, careers focusing on administration and communication are favorable options.',
                'score' => min(100, $average ? $average + 5 : 70)
            ];
        }

        foreach ($recommendedCareers as $recGroup) {
            foreach ($recGroup['name'] as $cName) {
                $career = Career::firstOrCreate(
                    ['name' => $cName],
                    ['description' => "Career in $cName", 'salary_range' => 'Competitive']
                );

                Recommendation::updateOrCreate(
                    [
                        'student_id' => $student->id,
                        'career_id' => $career->id
                    ],
                    [
                        'score' => $recGroup['score'],
                        'explanation' => $recGroup['explanation']
                    ]
                );
            }
        }

        return true;
    }
}
