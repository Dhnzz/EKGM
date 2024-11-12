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
        'question_json',
        'question_type',
        'category',
    ];
    protected $casts = [
        'question_json' => 'array', // Meng-cast kolom JSON ke array agar lebih mudah digunakan
    ];

    public function respondens(): BelongsToMany
    {
        return $this->belongsToMany(Responden::class, 'tb_answers', 'tb_question_id', 'responden_id')
            ->withPivot('anwswer')
            ->withTimestamps();
    }
}
