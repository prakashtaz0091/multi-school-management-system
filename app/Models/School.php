<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class School extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'phone',
        'email',
        'website',
    ];


    public function users(): HasMany
    {

        return $this->hasMany(User::class);
    }

    public function classes(): HasMany
    {

        return $this->hasMany(Classes::class);
    }

    public function students(): HasMany
    {

        return $this->hasMany(Student::class);
    }


    public function guardians(): HasMany
    {
        return $this->hasMany(Guardian::class);
    }
}
