<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'description',
        'full_marks',
        'pass_marks',
        'class_id',
        'teacher_id',
        'school_id'
    ];

    public function classes()
    {
        return $this->belongsTo(Classes::class, 'class_id', 'id');
    }

    public function teacher()
    {
        return $this->belongsTo(Staff::class, 'teacher_id', 'id');
    }

    public function school()
    {
        return $this->belongsTo(School::class);
    }
}
