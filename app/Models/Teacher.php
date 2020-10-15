<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Teacher extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'first_name', 'last_name', 'telephone', 'email'
    ];

    public function classes()
    {
        return $this->hasMany(TeacherClass::class, 'teacher_id');
    }

    public function students()
    {
        return $this->hasMany(Student::class, 'teacher_id');
    }
}
