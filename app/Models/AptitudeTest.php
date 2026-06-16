<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AptitudeTest extends Model
{
    protected $fillable = [
        'title',
        'description'
    ];

    public function questions()
    {
        return $this->hasMany(AptitudeQuestion::class);
    }

    public function results()
    {
        return $this->hasMany(AptitudeResult::class);
    }
}
