<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = [
        'status',
        'attendance_method',
        'checked_in_at',
    ];

    public function classSchedule()
    {
        return $this->belongsTo(Class_schedule::class);
    }

    public function seat()
    {
        return $this->belongsTo(Seat::class);
    }
}
