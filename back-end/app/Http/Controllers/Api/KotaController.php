<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kota;
use Illuminate\Support\Facades\Validator;

class KotaController extends Controller
{
    public function index() // Method read atau menampilkan semua data drop point
    {
        $kotas = Kota::all(); //  Mengambil semua data drop point

        if(count($kotas) > 0){
            return response([
                'message' => 'Retrieve All Success',
                'data' => $kotas
            ], 200);
        }// return data semua drop point dalam bentuk json

        return response([
            'message' => 'Empty',
            'data' => null
        ], 400);    // return message data course kosong
    }

    public function show($id) // Method read atau menampilkan data drop point berdasarkan id
    {
        $kota = Kota::find($id); //  Mengambil data drop point berdasarkan id

        if(!is_null($kota)){
            return response([
                'message' => 'Retrieve Drop Point Success',
                'data' => $kota
            ], 200);
        }// return data drop point dalam bentuk json

        return response([
            'message' => 'Drop Point Not Found',
            'data' => null
        ], 404);    // return message data drop point tidak ditemukan
    }

    public function store(Request $request) // Method create atau menambah data drop point
    {
        $storeData = $request->all();    // Mengambil seluruh data input dan menyimpan dalam variabel storeData
        $validate = Validator::make($storeData, [
            'idKota' => 'required',
            'namaDropPoint' => 'required',
            'alamat' => 'required'
        ]);    // rule validasi input saat register

        if($validate->fails())    // Mengecek apakah inputan sudah sesuai dengan rule validasi
            return response(['message' => $validate->errors()], 400);   // Mengembalikan error validasi input

        $kota = Kota::create($storeData);    // Membuat drop point baru

        return response([
            'message' => 'Add Drop Point Success',
            'data' => $kota,
        ], 200); // return data drop point dalam bentuk json
    }

    public function destroy($id) // Method delete atau menghapus data drop point berdasarkan id
    {
        $kota = Kota::find($id); //  Mengambil data drop point berdasarkan id

        if(is_null($kota)){
            return response([
                'message' => 'Drop Point Not Found',
                'data' => null
            ], 404);    // return message data drop point tidak ditemukan
        }

        if($kota->delete()){
            return response([
                'message' => 'Delete Drop Point Success',
                'data' => $kota,
            ], 200); // return data drop point dalam bentuk json
        }

        return response([
            'message' => 'Delete Drop Point Failed',
            'data' => null,
        ], 400); // return data drop point dalam bentuk json
    }

    public function update(Request $request, $id) // Method update atau mengubah data drop point berdasarkan id
    {
        $kota = Kota::find($id); //  Mengambil data drop point berdasarkan id

        if(is_null($kota)){
            return response([
                'message' => 'Drop Point Not Found',
                'data' => null
            ], 404);    // return message data drop point tidak ditemukan
        }

        $updateData = $request->all();    // Mengambil seluruh data input dan menyimpan dalam variabel updateData
        $validate = Validator::make($updateData, [
            'idKota' => 'required',
            'namaDropPoint' => 'required',
            'alamat' => 'required'
        ]);    // rule validasi input saat register

        if($validate->fails())    // Mengecek apakah inputan sudah sesuai dengan rule validasi
            return response(['message' => $validate->errors()], 400);   // Mengembalikan error validasi input

        $kota->idKota = $updateData['idKota'];
        $kota->namaDropPoint = $updateData['namaDropPoint'];
        $kota->alamat = $updateData['alamat'];

        if($kota->save()){
            return response([
                'message' => 'Update Drop Point Success',
                'data' => $kota,
            ], 200); // return data drop point dalam bentuk json
        }

        return response([
            'message' => 'Update Drop Point Failed',
            'data' => null,
        ], 400); // return data drop point dalam bentuk json
    }
}