<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassSchedule extends Model
{
    protected $fillable = [
        'class_id',
        'date',
        'start_time',
        'end_time',
        'attendance_code',
        'code_expires_at',
        'status',
    ];

    public function class()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}
