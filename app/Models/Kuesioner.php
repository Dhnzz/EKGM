<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{HasMany};

use App\Models\Question;

class Kuesioner extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'isActive',
    ];

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }

    public function respondenKuesioners(): HasMany
    {
        return $this->hasMany(RespondenKuesioner::class);
    }
}
