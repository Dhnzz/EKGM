<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TbAnswer extends Model
{
    use HasFactory;
    protected $fillable = [
        'responden_id',
        'tb_question_id',
        'answer_text',
        'answer_integer',
        'answer_boolean',
        'reason_boolean',
        'answer_date',
        'answer_json',
    ];

    public function responden(): BelongsTo
    {
        return $this->belongsTo(Responden::class, 'responden_id');
    }

    public function tb_question(): BelongsTo
    {
        return $this->belongsTo(TbQuestion::class, 'tb_question_id');
    }
}
