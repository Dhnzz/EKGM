<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

use App\Models\ResponKuesioner;

class Responden extends Model
{
    use HasFactory;
    protected $fillable = [
        'email',
        'name',
        'birth_date',
    ];

    public function kuesioner(): BelongsToMany
    {
        return $this->belongsToMany(Kuesioner::class, 'respon_kuesioner')->withPivot('isActive');
    }
}
