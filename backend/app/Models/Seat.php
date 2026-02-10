<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    protected $fillable = [
        'room_name',
        'seat_code',
    ];

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}
