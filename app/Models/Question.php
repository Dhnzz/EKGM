<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, BelongsToMany};

use App\Models\Kuesioner;

class Question extends Model
{
    use HasFactory;
    protected $fillable = [
        'kuesioner_id',
        'question'
    ];

    public function kuesioner(): BelongsTo
    {
        return $this->belongsTo(Kuesioner::class);
    }

    public function responden(): BelongsToMany
    {
        return $this->belongsToMany(Responden::class, 'answer_respondens')->withPivot('answer');
    }
}
