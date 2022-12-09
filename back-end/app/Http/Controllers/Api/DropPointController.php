<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DropPoint;

class DropPointController extends Controller
{
    public function index() // Method read atau menampilkan semua data customer
   {
       $kota = DropPoint::all(); //  Mengambil semua data kota

       if(count($paket) > 0){
           return response([
               'message' => 'Retrieve All Success',
               'data' => $kota
           ], 200);
       }// return data semua kota dalam bentuk json

       return response([
           'message' => 'Empty',
           'data' => null
       ], 400);    // return message data course kosong
   }
}
