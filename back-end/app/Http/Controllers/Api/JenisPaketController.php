<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JenisPaket;

class JenisPaketController extends Controller
{
    public function index()
    {
        $jenis = JenisPaket::all();

        if(count($jenis) > 0){
            return response([
                'message' => 'Retrieve All Success',
                'data' => $jenis
            ], 200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ], 400);
    }
}
