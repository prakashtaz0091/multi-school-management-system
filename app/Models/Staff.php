<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Staff extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function user(): BelongsTo
    {

        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function classes(): HasOne
    {
        return $this->hasOne(Classes::class, 'id');
    }
}
