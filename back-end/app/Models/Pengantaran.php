<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengantaran extends Model
{
    use HasFactory;

    protected $primaryKey = 'noResi';

    protected $casts = [
        'noResi' => 'string',
    ];


    protected $fillable = [
        'noResi',
        'nikKurir',
        'idDropPoint',
        'idStatus',
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

    public function status()
    {
        return $this->belongsTo(StatusPengantaran::class, 'idStatus', 'id');
    }
}
