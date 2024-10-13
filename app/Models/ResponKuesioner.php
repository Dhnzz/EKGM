<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\{Kuesioner, Responden};

class ResponKuesioner extends Model
{
    use HasFactory;
    protected $fillable = [
        'kuesioner_id',
        'responden_id',
        'isDo'
    ];
}
