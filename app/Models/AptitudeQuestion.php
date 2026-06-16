<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AptitudeQuestion extends Model
{
    protected $fillable = [
        'aptitude_test_id',
        'question',
        'option_a',
        'option_b',
        'option_c',
        'option_d',
        'correct_answer',
        'category'
    ];

    public function test()
    {
        return $this->belongsTo(AptitudeTest::class, 'aptitude_test_id');
    }
}
