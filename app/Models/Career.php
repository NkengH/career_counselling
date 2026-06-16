<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    protected $fillable = [
        'name',
        'description',
        'required_skills',
        'salary_range'
    ];

    public function recommendations()
    {
        return $this->hasMany(Recommendation::class);
    }
}
