<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CareerRecommendation extends Model
{
    use HasFactory;

    protected $fillable = [
        'session_id',
        'student_id',
        'field_of_study',
        'recommended_course',
        'alternative_courses',
        'recommended_careers',
        'strengths',
        'weaknesses',
        'reasoning',
        'confidence_score'
    ];

    protected $casts = [
        'alternative_courses' => 'array',
        'recommended_careers' => 'array',
        'strengths' => 'array',
        'weaknesses' => 'array'
    ];

    public function session()
    {
        return $this->belongsTo(AssessmentSession::class, 'session_id');
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
}
