<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Auth\Passwords\CanResetPassword as CanResetPasswordTrait;
use Illuminate\Notifications\Notifiable;

class master_akun extends Authenticatable implements CanResetPassword
{
    use Notifiable, HasFactory, CanResetPasswordTrait;

    protected $table = 'master_akun';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'id',
        'nik',
        'no_hp',
        'email',
        'foto_profil',
        'level',
        'password',
    ];
}
