<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AptitudeResult extends Model
{
    protected $fillable = [
        'student_id',
        'aptitude_test_id',
        'score',
        'category'
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function test()
    {
        return $this->belongsTo(AptitudeTest::class, 'aptitude_test_id');
    }
}
