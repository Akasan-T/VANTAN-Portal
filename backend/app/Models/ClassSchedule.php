<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassSchedule extends Model
{
    protected $fillable = [
        'class_id',
        'room_id',
        'date',
        'start_time',
        'end_time',
        'attendance_code',
        'code_expires_at',
        'status',
    ];

    protected $casts = [
        'date' => 'date',
        'code_expires_at' => 'datetime',
    ];

    public function class()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}
