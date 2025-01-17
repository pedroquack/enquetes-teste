<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Poll extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'start_date',
        'final_date',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'final_date' => 'datetime',
    ];

    public function options(): HasMany
    {
        return $this->hasMany(Option::class);
    }
}
