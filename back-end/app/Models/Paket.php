<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    use HasFactory;

    protected $primaryKey = 'noResi';
    
    protected $casts = [
        'noResi' => 'string',
    ];

    protected $fillable = [
        'noResi',
        'idPengirim',
        'idService',
        'idStatus',
        'jenisPaket',
        'berat',
        'volume',
        'namaPenerima',
        'noTelpPenerima',
        'alamatTujuan'
    ];

    public function pengirim()
    {
        return $this->belongsTo(User::class, 'idPengirim', 'id');
    }

    public function jenis_paket()
    {
        return $this->belongsTo(JenisPaket::class, 'jenisPaket', 'id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'idService', 'id');
    }

    public function pengantaran()
    {
        return $this->hasMany(Pengantaran::class, 'noResi', 'noResi')->with('kurir', 'dropPoint');
    }
    
    public function statusPaket()
    {
        return $this->belongsTo(StatusPaket::class, 'idStatus', 'id');
    }

}
