<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsToMany, HasMany};

use App\Models\Question;

class Kuesioner extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'isActive',
    ];

    public function question(): HasMany
    {
        return $this->hasMany(Question::class);
    }
}
