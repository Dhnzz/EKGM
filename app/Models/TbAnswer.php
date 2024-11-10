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
    ];

    public function responden(): HasMany
    {
        return $this->hasMany(Responden::class);
    }

    public function tbQuestion(): HasMany
    {
        return $this->hasMany(TbQuestion::class);
    }
}
