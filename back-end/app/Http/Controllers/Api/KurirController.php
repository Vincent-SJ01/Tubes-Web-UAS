<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kurir;
use Illuminate\Support\Facades\Validator;

class KurirController extends Controller
{
    public function index() // Method read atau menampilkan semua data product
    {
        $kurirs = Kurir::all(); //  Mengambil semua data product

        if(count($kurirs) > 0){
            return response([
                'message' => 'Retrieve All Success',
                'data' => $kurirs
            ], 200);
        }// return data semua product dalam bentuk json

        return response([
            'message' => 'Empty',
            'data' => null
        ], 400);    // return message data course kosong
    }

    public function show($id) // Method read atau menampilkan data product berdasarkan id
    {
        $kurir = Kurir::find($id); //  Mengambil data product berdasarkan id

        if(!is_null($kurir)){
            return response([
                'message' => 'Retrieve Kurir Success',
                'data' => $kurir
            ], 200);
        }// return data product dalam bentuk json

        return response([
            'message' => 'Kurir Not Found',
            'data' => null
        ], 404);    // return message data product tidak ditemukan
    }

    public function store(Request $request) // Method create atau menambah data product
    {
        $storeData = $request->all();    // Mengambil seluruh data input dan menyimpan dalam variabel storeData
        $validate = Validator::make($storeData, [
            'nama' => 'required',
            'username' => 'required',
            'password' => 'required',
            'email' => 'required',
            'nik' => 'required',
            'noTelp' => 'required',
            'alamat' => 'required',
            'tanggalLahir' => 'required',
            'gender' => 'required',
            'status' => 'required',
            'idRole' => 'required',
        ]);    // rule validasi input saat register

        if($validate->fails())    // Mengecek apakah inputan sudah sesuai dengan rule validasi
            return response(['message' => $validate->errors()], 400);   // Mengembalikan error validasi input

        $kurir = Kurir::create($storeData);    // Membuat product baru

        return response([
            'message' => 'Add Kurir Success',
            'data' => $kurir,
        ], 200);    // return data product yang baru dibuat dalam bentuk json
    }

    public function destroy($id) // Method delete atau menghapus data product berdasarkan id
    {
        $kurir = Kurir::find($id); //  Mengambil data product berdasarkan id

        if(is_null($kurir)){
            return response([
                'message' => 'Kurir Not Found',
                'data' => null
            ], 404);    // return message data product tidak ditemukan
        }

        if($kurir->delete()){
            return response([
                'message' => 'Delete Kurir Success',
                'data' => $kurir,
            ], 200);    // return message hapus data product berhasil
        }

        return response([
            'message' => 'Delete Kurir Failed',
            'data' => null,
        ], 400);    // return message hapus data product gagal
    }

    public function update(Request $request, $id) // Method update atau mengubah data product berdasarkan id
    {
        $kurir = Kurir::find($id); //  Mengambil data product berdasarkan id

        if(is_null($kurir)){
            return response([
                'message' => 'Kurir Not Found',
                'data' => null
            ], 404);    // return message data product tidak ditemukan
        }

        $updateData = $request->all();  // Mengambil seluruh data input dan menyimpan dalam variabel updateData
        $validate = Validator::make($updateData, [
            'nama' => 'required',
            'username' => 'required',
            'password' => 'required',
            'email' => 'required',
            'nik' => 'required',
            'noTelp' => 'required',
            'alamat' => 'required',
            'tanggalLahir' => 'required',
            'gender' => 'required',
            'status' => 'required',
            'idRole' => 'required',
        ]);    // rule validasi input saat register

        if($validate->fails())    // Mengecek apakah inputan sudah sesuai dengan rule validasi
            return response(['message' => $validate->errors()], 400);   // Mengembalikan error validasi input

        $kurir->namaKurir = $updateData['namaKurir'];
        $kurir->noTelp = $updateData['noTelp'];
        $kurir->alamat = $updateData['alamat'];

        if($kurir->save()){
            return response([
                'message' => 'Update Kurir Success',
                'data' => $kurir,
            ], 200);    // return message update data product berhasil
        }

        return response([
            'message' => 'Update Kurir Failed',
            'data' => null,
        ], 400);    // return message update data product gagal
    }
}
