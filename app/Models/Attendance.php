<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Attendance extends Model
{
    use HasFactory;

    protected $guarded = ['id'];


    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }


    public function class()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }
}
