<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsToMany};

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name'
    ];

    public function todo(): BelongsToMany
    {
        return $this->belongsToMany(Todo::class, 'category_todos');
    }
}
