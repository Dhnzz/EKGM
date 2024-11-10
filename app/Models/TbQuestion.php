<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TbQuestion extends Model
{
    use HasFactory;
    protected $fillable = [
        'instrument',
        'question_sub',
        'question_text',
        'question_type',
        'category',
    ];

    public function tbAnswer(): BelongsTo
    {
        return $this->belongsTo(TbAnswer::class);
    }
}
