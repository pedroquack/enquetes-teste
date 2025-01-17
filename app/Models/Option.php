<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Option extends Model
{
    use HasFactory;

    protected $fillable = [
        'text',
        'votes',
        'poll_id'
    ];

    public function poll(): HasOne
    {
        return $this->hasOne(Poll::class);
    }
}
