<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kurir extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'username',
        'password',
        'email',
        'alamat',
        'nik',
        'noTelp',
        'alamat',
        'tanggalLahir',
        'gender',
        'status'
    ];
}
