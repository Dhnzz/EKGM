<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ohis extends Model
{
    use HasFactory;
    protected $fillable = [
        'responden_id',
        'date',
        'di_1',
        'di_2',
        'di_3',
        'di_4',
        'di_5',
        'di_6',
        'ci_1',
        'ci_2',
        'ci_3',
        'ci_4',
        'ci_5',
        'ci_6',
        'total_di',
        'total_ci',
        'ohi',
        'kesimpulan',
    ];

    public function responden(): BelongsTo
    {
        return $this->belongsTo(Responden::class);
    }
}
