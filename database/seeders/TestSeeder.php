<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AptitudeTest;
use App\Models\AptitudeQuestion;

class TestSeeder extends Seeder
{
    public function run(): void
    {
        $test1 = AptitudeTest::create([
            'title' => 'Core Aptitude Diagnostics Assessment',
            'description' => 'A comprehensive 5-minute preliminary assessment evaluating structural components across Logic, Mathematics, and Biomedical Science paradigms.'
        ]);

        // Math Questions
        AptitudeQuestion::create([
            'aptitude_test_id' => $test1->id,
            'question' => 'What is 15% of 200?',
            'option_a' => '20',
            'option_b' => '30',
            'option_c' => '40',
            'option_d' => '50',
            'correct_answer' => 'option_b',
            'category' => 'Mathematics'
        ]);
        AptitudeQuestion::create([
            'aptitude_test_id' => $test1->id,
            'question' => 'Solve for x: 2x + 5 = 15',
            'option_a' => 'x = 3',
            'option_b' => 'x = 5',
            'option_c' => 'x = 7',
            'option_d' => 'x = 10',
            'correct_answer' => 'option_b',
            'category' => 'Mathematics'
        ]);

        // Logical Reasoning
        AptitudeQuestion::create([
            'aptitude_test_id' => $test1->id,
            'question' => 'If A is taller than B, and B is taller than C, who is the tallest?',
            'option_a' => 'A',
            'option_b' => 'B',
            'option_c' => 'C',
            'option_d' => 'Cannot be determined',
            'correct_answer' => 'option_a',
            'category' => 'Logical Reasoning'
        ]);
        AptitudeQuestion::create([
            'aptitude_test_id' => $test1->id,
            'question' => 'Which number comes next in the sequence: 2, 4, 8, 16, ?',
            'option_a' => '24',
            'option_b' => '32',
            'option_c' => '64',
            'option_d' => '20',
            'correct_answer' => 'option_b',
            'category' => 'Logical Reasoning'
        ]);

        // Biology
        AptitudeQuestion::create([
            'aptitude_test_id' => $test1->id,
            'question' => 'What is the structural and functional unit of life forming the "powerhouse" generator?',
            'option_a' => 'Nucleus',
            'option_b' => 'Mitochondria',
            'option_c' => 'Ribosome',
            'option_d' => 'Endoplasmic Reticulum',
            'correct_answer' => 'option_b',
            'category' => 'Biology'
        ]);
    }
}
