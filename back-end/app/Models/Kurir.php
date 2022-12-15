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

    protected $primaryKey = 'nik';

    protected $casts = [
        'nik' => 'string',
    ];

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
        'idStatus',
        'idRole'
    ];

    protected $hidden = [
        'password',
    ];

    public function gender()
    {
        return $this->belongsTo(Gender::class, 'gender', 'id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'idStatus', 'id');
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'idRole', 'id');
    }


}
