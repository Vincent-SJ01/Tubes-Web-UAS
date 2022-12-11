<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Paket;
use Illuminate\Support\Facades\Validator;

class PaketController extends Controller
{
    public function index() // Method read atau menampilkan semua data customer
    {
        $customers = Paket::all(); //  Mengambil semua data customer

        if(count($customers) > 0){
            return response([
                'message' => 'Retrieve All Success',
                'data' => $customers
            ], 200);
        }// return data semua customer dalam bentuk json

        return response([
            'message' => 'Empty',
            'data' => null
        ], 400);    // return message data course kosong
    }

    public function show($id) // Method read atau menampilkan data customer berdasarkan id
    {
        $customer = Paket::all()->where('noResi', '=', $id); //  Mengambil data customer berdasarkan id

        if(!is_null($customer)){
            return response([
                'message' => 'Retrieve Customer Success',
                'data' => $customer
            ], 200);
        }// return data customer dalam bentuk json

        return response([
            'message' => 'Customer Not Found',
            'data' => null
        ], 404);    // return message data customer tidak ditemukan
    }

    public function store(Request $request) // Method create atau menambah data customer
    {
        $storeData = $request->all();    // Mengambil seluruh data input dan menyimpan dalam variabel storeData
        $validate = Validator::make($storeData, [
            'noResi' => 'required',
            'idPengirim' => 'required',
            'jenisPaket' => 'required',
            'berat' => 'required',
            'volume' => 'required',
            'namaPenerima' => 'required',
            'noTelpPenerima' => 'required',
            'alamatTujuan' => 'required',
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()], 400);
        
        $paket = Paket::create($storeData); // Menambah data customer baru
        return response([
            'message' => 'Add Customer Success',
            'data' => $paket,
        ], 200); // return data customer yang baru saja ditambahkan dalam bentuk json
    }
    
    public function destroy($id) // Method delete atau menghapus data customer berdasarkan id
    {
        $paket = Paket::find($id); //  Mengambil data customer berdasarkan id

        if(is_null($paket)){
            return response([
                'message' => 'Paket Not Found',
                'data' => null
            ], 404);
        }

        if($paket->delete()){
            return response([
                'message' => 'Delete Paket Success',
                'data' => $paket,
            ], 200);
        }

        return response([
            'message' => 'Delete Paket Failed',
            'data' => null,
        ], 400);
    }

    public function update(Request $request, $id) // Method update atau mengubah data customer berdasarkan id
    {
        $paket = Paket::find($id); //  Mengambil data customer berdasarkan id

        if(is_null($paket)){
            return response([
                'message' => 'Paket Not Found',
                'data' => null
            ], 404);
        }

        $updateData = $request->all(); // Mengambil seluruh data input dan menyimpan dalam variabel updateData
        $validate = Validator::make($updateData, [
            'noResi' => 'required',
            'idPengirim' => 'required',
            'jenisPaket' => 'required',
            'berat' => 'required',
            'volume' => 'required',
            'namaPenerima' => 'required',
            'noTelpPenerima' => 'required',
            'alamatTujuan' => 'required',
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()], 400);

        $paket->noResi = $updateData['noResi'];
        $paket->idPengirim = $updateData['idPengirim'];
        $paket->jenisPaket = $updateData['jenisPaket'];
        $paket->berat = $updateData['berat'];
        $paket->volume = $updateData['volume'];
        $paket->namaPenerima = $updateData['namaPenerima'];
        $paket->noTelpPenerima = $updateData['noTelpPenerima'];
        $paket->alamatTujuan = $updateData['alamatTujuan'];

        if($paket->save()){
            return response([
                'message' => 'Update Paket Success',
                'data' => $paket,
            ], 200);
        }

        return response([
            'message' => 'Update Paket Failed',
            'data' => null,
        ], 400);
    }

}
