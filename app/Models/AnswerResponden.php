<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnswerResponden extends Model
{
    use HasFactory;
    protected $fillable = [
        'question_id',
        'responden_id',
        'answer'
    ];

}
