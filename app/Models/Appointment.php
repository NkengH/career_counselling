<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'student_id',
        'counsellor_id',
        'appointment_date',
        'appointment_time',
        'status'
    ];

    protected function casts(): array
    {
        return [
            'appointment_date' => 'date',
        ];
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function counsellor()
    {
        return $this->belongsTo(User::class, 'counsellor_id');
    }
}
