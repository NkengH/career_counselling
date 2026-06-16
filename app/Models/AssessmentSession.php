<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssessmentSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'status',
        'confidence_score'
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function questions()
    {
        return $this->hasMany(AssessmentQuestion::class, 'session_id');
    }

    public function recommendation()
    {
        return $this->hasOne(CareerRecommendation::class, 'session_id');
    }
}
