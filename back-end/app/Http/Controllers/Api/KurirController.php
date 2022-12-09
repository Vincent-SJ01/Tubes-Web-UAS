<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kurir;

class KurirController extends Controller
{
    public function index() // Method read atau menampilkan semua data customer
    {
        $pengantaran = Kurir::all(); //  Mengambil semua data pengantaran

        if(count($pengantaran) > 0){
            return response([
                'message' => 'Retrieve All Success',
                'data' => $pengantaran
            ], 200);
        }// return data semua pengantaran dalam bentuk json

        return response([
            'message' => 'Empty',
            'data' => null
        ], 400);    // return message data course kosong
    }
}
