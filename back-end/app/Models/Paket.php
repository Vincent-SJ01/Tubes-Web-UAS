<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    use HasFactory;

    protected $primaryKey = 'noResi';

    protected $fillable = [
        'noResi',
        'idPengirim',
        'idService',
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

    public function jenisPaket()
    {
        return $this->belongsTo(JenisPaket::class, 'jenisPaket', 'id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'idService', 'id');
    }
}
