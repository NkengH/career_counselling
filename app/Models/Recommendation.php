<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recommendation extends Model
{
    protected $fillable = [
        'student_id',
        'career_id',
        'score',
        'explanation'
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function career()
    {
        return $this->belongsTo(Career::class, 'career_id');
    }
}
