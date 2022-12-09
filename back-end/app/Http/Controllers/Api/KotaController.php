<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kota;

class KotaController extends Controller
{
     public function index() // Method read atau menampilkan semua data customer
    {
        $paket = Kota::all(); //  Mengambil semua data paket

        if(count($paket) > 0){
            return response([
                'message' => 'Retrieve All Success',
                'data' => $paket
            ], 200);
        }// return data semua paket dalam bentuk json

        return response([
            'message' => 'Empty',
            'data' => null
        ], 400);    // return message data course kosong
    }
}
