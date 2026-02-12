<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{

    protected $fillable = [
        'teacher_id',
        'class_name',
        'department_name',
        'grade',
        'school_year',
        'term',
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function schedules()
    {
        return $this->hasMany(ClassSchedule::class, 'class_id');
    }
    
}
