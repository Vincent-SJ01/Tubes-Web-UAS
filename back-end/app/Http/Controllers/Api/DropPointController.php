<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DropPoint;
use Illuminate\Support\Facades\Validator;

class DropPointController extends Controller
{
    public function index() // Method read atau menampilkan semua data drop point
    {
        $dropPoints = DropPoint::with('kota')->get(); //  Mengambil semua data drop point

        if(count($dropPoints) > 0){
            return response([
                'message' => 'Retrieve All Success',
                'data' => $dropPoints
            ], 200);
        }// return data semua drop point dalam bentuk json

        return response([
            'message' => 'Empty',
            'data' => null
        ], 400);    // return message data course kosong
    }

    public function show($id) // Method read atau menampilkan data drop point berdasarkan id
    {
        $dropPoint = DropPoint::find($id); //  Mengambil data drop point berdasarkan id

        if(!is_null($dropPoint)){
            return response([
                'message' => 'Retrieve Drop Point Success',
                'data' => $dropPoint
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

        $dropPoint = DropPoint::create($storeData);    // Membuat drop point baru

        return response([
            'message' => 'Add Drop Point Success',
            'data' => $dropPoint,
        ], 200); // return data drop point dalam bentuk json
    }

    public function destroy($id) // Method delete atau menghapus data drop point berdasarkan id
    {
        $dropPoint = DropPoint::find($id); //  Mengambil data drop point berdasarkan id

        if(is_null($dropPoint)){
            return response([
                'message' => 'Drop Point Not Found',
                'data' => null
            ], 404);    // return message data drop point tidak ditemukan
        }

        if($dropPoint->delete()){
            return response([
                'message' => 'Delete Drop Point Success',
                'data' => $dropPoint,
            ], 200); // return data drop point dalam bentuk json
        }

        return response([
            'message' => 'Delete Drop Point Failed',
            'data' => null,
        ], 400); // return data drop point dalam bentuk json
    }

    public function update(Request $request, $id) // Method update atau mengubah data drop point berdasarkan id
    {
        $dropPoint = DropPoint::find($id); //  Mengambil data drop point berdasarkan id

        if(is_null($dropPoint)){
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

        $dropPoint->idKota = $updateData['idKota'];
        $dropPoint->namaDropPoint = $updateData['namaDropPoint'];
        $dropPoint->alamat = $updateData['alamat'];

        if($dropPoint->save()){
            return response([
                'message' => 'Update Drop Point Success',
                'data' => $dropPoint,
            ], 200); // return data drop point dalam bentuk json
        }

        return response([
            'message' => 'Update Drop Point Failed',
            'data' => null,
        ], 400); // return data drop point dalam bentuk json
    }
}
