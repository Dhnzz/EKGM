<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, BelongsToMany};

class Todo extends Model
{
    use HasFactory;
    protected $fillable = [
        'date',
        'responden_id',
        'category_id'
    ];

    public function responden(): BelongsTo
    {
        return $this->belongsTo(Responden::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

}
