<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Kota extends Model
{
    use HasFactory, HasApiTokens, Notifiable;
    protected $fillable = [
        'namaKota',
    ];
}
