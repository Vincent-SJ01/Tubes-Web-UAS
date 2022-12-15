<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengantaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'noResi',
        'nikKurir',
        'idDropPoint',
        'keterangan'
    ];

    public function paket()
    {
        return $this->belongsTo(Paket::class, 'noResi', 'noResi');
    }

    public function kurir()
    {
        return $this->belongsTo(Kurir::class, 'nikKurir', 'nik');
    }

    public function dropPoint()
    {
        return $this->belongsTo(DropPoint::class, 'idDropPoint', 'id');
    }

    public function noResi()
    {
        return $this->belongsTo(Paket::class, 'noResi', 'noResi');
    }


}
