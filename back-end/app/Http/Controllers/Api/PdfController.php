<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Paket;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\URL;

class PdfController extends Controller
{
    public function resiPaket($id)
    {
        $paket = Paket::with('pengirim', 'jenis_paket', 'service')->where('noResi', '=', $id)->get();
        $url = URL::current();
        // return $paket;
        $data = [
            'url' => $url,
            'paket' => $paket
        ];

        $pdf = PDF::loadView('resi', $data);
        return $pdf->stream('resi.pdf');
        // return view('resi', $data);
    }
}
