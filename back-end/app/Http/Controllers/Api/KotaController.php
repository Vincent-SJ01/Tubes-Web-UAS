<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kota;
use Illuminate\Support\Facades\Validator;

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
<<<<<<< Updated upstream
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
=======

    public function show($id) // Method read atau menampilkan data customer berdasarkan id
    {
        $paket = Kota::find($id); //  Mengambil data paket berdasarkan id

        if(!is_null($paket)){
            return response([
                'message' => 'Retrieve Paket Success',
                'data' => $paket
            ], 200);
        }// return data paket dalam bentuk json

        return response([
            'message' => 'Paket Not Found',
            'data' => null
        ], 404);    // return message data paket tidak ditemukan
    }

    public function store(Request $request) // Method create atau menambah data customer
    {
        $storeData = $request->all();    // Mengambil seluruh data input dan menyimpan dalam variabel storeData
        $validate = Validator::make($storeData, [
            'namaKota' => 'required',
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()], 400); // return error validasi

        $paket = Kota::create($storeData); // Menambah data paket baru

        return response([
            'message' => 'Add Kota Success',
            'data' => $paket,
        ], 200); // return data paket yang baru saja ditambahkan
    }

    public function destroy($id) // Method delete atau menghapus data customer berdasarkan id
    {
        $paket = Kota::find($id); //  Mengambil data paket berdasarkan id

        if(is_null($paket)){
            return response([
                'message' => 'Paket Not Found',
                'data' => null
            ], 404);    // return message data paket tidak ditemukan
        }

        if($paket->delete()){
            return response([
                'message' => 'Delete Kota Success',
                'data' => $paket,
            ], 200); // return data paket yang baru saja dihapus
>>>>>>> Stashed changes
        }

        return response([
            'message' => 'Delete Kota Failed',
            'data' => null,
<<<<<<< Updated upstream
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
=======
        ], 400); // return message data paket gagal dihapus
    }

    public function update(Request $request, $id) // Method update atau mengubah data customer berdasarkan id
    {
        $kota = Kota::find($id); //  Mengambil data paket berdasarkan id

        if(!is_null($kota)){
            return response([
                'message' => 'Retrieve Kota Success',
                'data' => $kota
            ], 200);
        }// return data paket dalam bentuk json

        return response([
            'message' => 'Kota Not Found',
            'data' => null
        ], 404);    // return message data paket tidak ditemukan

        $updateData = $request->all(); // Mengambil seluruh data input dan menyimpan dalam variabel updateData
        $validate = Validator::make($updateData, [
            'namaKota' => 'required',
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()], 400); // return error validasi

        $kota->namaKota = $updateData['namaKota'];
        if($kota->save()){
            return response([
                'message' => 'Update Kota Success',
                'data' => $kota,
            ], 200); // return data paket yang baru saja diubah
>>>>>>> Stashed changes
        }

        return response([
            'message' => 'Update Kota Failed',
            'data' => null,
<<<<<<< Updated upstream
        ], 400); 
    }

=======
        ], 400); // return message data paket gagal diubah
    }
>>>>>>> Stashed changes
}
