<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Paket;

class PaketController extends Controller
{
    public function index() // Method read atau menampilkan semua data customer
    {
        $customers = Paket::all(); //  Mengambil semua data customer

        if(count($customers) > 0){
            return response([
                'message' => 'Retrieve All Success',
                'data' => $customers
            ], 200);
        }// return data semua customer dalam bentuk json

        return response([
            'message' => 'Empty',
            'data' => null
        ], 400);    // return message data course kosong
    }
}
