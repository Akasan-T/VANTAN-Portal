<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // 教師
    public function teacher()
    {
        return $this->hasOne(Teacher::class);
    }

    // 学生
    public function student()
    {
        return $this->hasOne(Student::class);
    }

    // Filament 管理画面へのアクセス制御
    public function canAccessPanel(Panel $panel): bool
    {
        // とりあえず全員OK（あとで role 判定に変えられる）
        return true;
    }
}