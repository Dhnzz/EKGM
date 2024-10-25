<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PeriksaGigi extends Model
{
    use HasFactory;
    protected $fillable = [
        'date',
        'result',
        'image',
        'ohis',
        'responden_id',
    ];

    public function responden(): BelongsTo
    {
        return $this->belongsTo(Responden::class);
    }
}
