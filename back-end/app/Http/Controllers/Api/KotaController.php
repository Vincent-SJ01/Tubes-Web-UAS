<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kota;

class KotaController extends Controller
{
     public function index() // Method read atau menampilkan semua data customer
    {
        $kotas = Kota::all(); //  Mengambil semua data paket

        if(count($kotas) > 0){
            return response([
                'message' => 'Retrieve All Success',
                'data' => $kotas
            ], 200);
        }// return data semua paket dalam bentuk json

        return response([
            'message' => 'Empty',
            'data' => null
        ], 400);    // return message data course kosong
    }
    public function show($id) // Method read atau menampilkan data kota berdasarkan id
    {
        $kotas = Kota::find($id); //  Mengambil data kota berdasarkan id

        if(!is_null($kotas)){
            return response([
                'message' => 'Retrieve Kota Success',
                'data' => $kotas
            ], 200);
        }// return data kota dalam bentuk json

        return response([
            'message' => 'Kota Not Found',
            'data' => null
        ], 404);    // return message data dkotat tidak ditemukan
    }

    public function store(Request $request) // Method create atau menambah data kota
    {
        $storeData = $request->all();    // Mengambil seluruh data input dan menyimpan dalam variabel storeKota
        $validate = Validator::make($storeData, [
            'namaKota' => 'required'
        ]);    // rule validasi input saat register

        

        if($validate->fails())    // Mengecek apakah inputan sudah sesuai dengan rule validasi
            return response(['message' => $validate->errors()], 400);   // Mengembalikan error validasi input

        $kotas = Kota::create($storeData);    // Membuat kota baru

        return response([
            'message' => 'Add Kota Success',
            'data' => $kotas,
        ], 200); // return data kota dalam bentuk json
    }


    public function destroy($id) // Method delete atau menghapus data kota berdasarkan id
    {
        $kotas = Kota::find($id); //  Mengambil data kota berdasarkan id

        if(is_null($kotas)){
            return response([
                'message' => 'Kota Not Found',
                'data' => null
            ], 404);    // return message data kota tidak ditemukan
        }

        if($kotas->delete()){
            return response([
                'message' => 'Delete Kota Success',
                'data' => $kotas,
            ], 200); // return data kota dalam bentuk json
        }

        return response([
            'message' => 'Delete Kota Failed',
            'data' => null,
        ], 400); // return data kota dalam bentuk json
    }


    public function update(Request $request, $id) 
    {
        $kotas = Kota::find($id); 

        if(is_null($kotas)){
            return response([
                'message' => 'Kota Not Found',
                'data' => null
            ], 404);    // return message data kota tidak ditemukan
        }

        $updateData = $request->all();    // Mengambil seluruh data input dan menyimpan dalam variabel updateData
        $validate = Validator::make($updateData, [
            'namaKota' => 'required',
        ]);    // rule validasi input saat register

        if($validate->fails())    // Mengecek apakah inputan sudah sesuai dengan rule validasi
            return response(['message' => $validate->errors()], 400);   // Mengembalikan error validasi input
                $kotas->namaKota = $updateData['namaKota'];

        if($kotas->save()){
            return response([
                'message' => 'Update Kota Success',
                'data' => $kotas,
            ], 200); 
        }

        return response([
            'message' => 'Update Kota Failed',
            'data' => null,
        ], 400); 
    }

}
