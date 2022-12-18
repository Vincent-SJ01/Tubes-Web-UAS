<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;

class ServiceController extends Controller
{
    public function index()
    {
        $service = Service::all();

        if(count($service) > 0){
            return response([
                'message' => 'Retrieve All Success',
                'data' => $service
            ], 200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ], 400);
    }
}
