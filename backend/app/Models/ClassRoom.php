<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassRoom extends Model
{
    protected $table = 'classes';

    protected $fillable = [
        'class_name',
        'department_name',
        'grade',
        'school_year',
        'term'
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function schedules()
    {
        return $this->hasMany(Class_schedule::class, 'class_id');
    }
}
