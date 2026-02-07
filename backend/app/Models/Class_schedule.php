<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Class_schedule extends Model
{
    protected $fillable = [
        'date',
        'start_time',
        'end_time',
        'attendance_code',
        'code_expires_at',
        'status',
    ];

    public function class()
    {
        return $this->belongsTo(ClassRoom::class, 'class_id');
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}
