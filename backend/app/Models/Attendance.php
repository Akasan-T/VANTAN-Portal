<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = [
        'student_id',
        'class_schedule_id',
        'seat_id',
        'status',
        'attendance_method',
        'checked_in_at',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function schedule()
    {
        return $this->belongsTo(ClassSchedule::class);
    }

    public function seat()
    {
        return $this->belongsTo(Seat::class);
    }
}
