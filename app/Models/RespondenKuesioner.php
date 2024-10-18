<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo};

class RespondenKuesioner extends Model
{
    use HasFactory;
    protected $fillable = [
        'kuesioner_id',
        'responden_id',
        'question_id',
        'answer',
    ];

    public function responden(): BelongsTo
    {
        return $this->belongsTo(Responden::class);
    }

    public function kuesioner(): BelongsTo
    {
        return $this->belongsTo(Responden::class);
    }

    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }
}
