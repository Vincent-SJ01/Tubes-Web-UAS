<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Kurir extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $guard = 'kurir';

    protected $fillable = [
        'nama',
        'username',
        'password',
        'email',
        'alamat',
        'nik',
        'noTelp',
        'tanggalLahir',
        'gender',
        'status',
        'idRole'
    ];

    protected $hidden = [
        'password',
    ];
}
