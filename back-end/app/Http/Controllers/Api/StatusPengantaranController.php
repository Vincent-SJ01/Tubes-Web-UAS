<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\StatusPengantaran;
use Illuminate\Http\Request;

class StatusPengantaranController extends Controller
{
    public function index()
    {
        $status = StatusPengantaran::all();

        if(count($status) > 0){
            return response([
                'message' => 'Retrieve All Success',
                'data' => $status
            ], 200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ], 400);
    }
}
