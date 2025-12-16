<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, HasProfilePhoto, Notifiable, TwoFactorAuthenticatable;

   protected $fillable = [
    'name',
    'matric_no',
    'email',
    'password',
    'role',

    'phone',
    'dob',
    'kulliyyah',
    'study_level',
    'nationality',
    'about_me',
    'hobby',
    'looking_for',
    'profile_photo',
];


    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = [
        'profile_photo_url',
    ];

    // Optional helper methods
    public function isStudent() { return $this->role === 'student'; }
    public function isGuardian() { return $this->role === 'guardian'; }
    public function isAdmin() { return $this->role === 'admin'; }
}
