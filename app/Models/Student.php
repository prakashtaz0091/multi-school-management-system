<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    use HasFactory;


    public function user(): BelongsTo
    {

        return $this->belongsTo(User::class, 'user_id', 'id');
    }


    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }


    public function classes(): BelongsTo
    {
        return $this->belongsTo(Classes::class);
    }

    public function guardians(): HasMany
    {

        return $this->hasMany(Guardian::class);
    }
}
