<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentProfile extends Model
{
    protected $fillable = [
        'user_id',
        'gender',
        'date_of_birth',
        'phone',
        'address',
        'academic_level',
        'interests',
        'skills'
    ];

    protected function casts(): array
    {
        return [
            'interests' => 'array',
            'skills' => 'array',
            'date_of_birth' => 'date',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
