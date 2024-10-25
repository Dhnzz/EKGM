<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{HasMany, BelongsToMany, HasOne};

use App\Models\ResponKuesioner;

class Responden extends Model
{
    use HasFactory;
    protected $fillable = ['phone', 'name', 'birth_date'];

    public function kuesioner(): HasMany
    {
        return $this->hasMany(RespondenKuesioner::class);
    }

    public function todo(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'todos');
    }

    public function periksaGigi(): HasOne
    {
        return $this->hasOne(PeriksaGigi::class, 'todos');
    }

}
