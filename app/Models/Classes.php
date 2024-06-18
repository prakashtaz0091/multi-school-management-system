<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Classes extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'room_no', 'school_id', 'year', 'class_teacher_id'];

    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }

    public function students(): HasMany
    {
        return $this->hasMany(Student::class, 'class_id', 'id');
    }

    public function subjects(): HasMany
    {
        return $this->hasMany(Subject::class, 'class_id', 'id');
    }

    public function class_teacher(): BelongsTo
    {
        return $this->belongsTo(Staff::class, 'class_teacher_id');
    }
}
