<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Paket;
use Illuminate\Support\Facades\Validator;

class PaketController extends Controller
{
    public function index() // Method read atau menampilkan semua data paket
    {
        $pakets = Paket::with('pengirim', 'service', 'pengantaran', 'statusPaket')->get(); //  Mengambil semua data paket

        if(count($pakets) > 0){
            return response([
                'message' => 'Retrieve All Success',
                'data' => $pakets
            ], 200);
        }// return data semua paket dalam bentuk json

        return response([
            'message' => 'Empty',
            'data' => null
        ], 400);    // return message data course kosong
    }

    public function show($id) // Method read atau menampilkan data paket berdasarkan id
    {
        $paket = Paket::with('pengirim', 'jenis_paket', 'service', 'pengantaran', 'statusPaket')->where('noResi', '=', $id)->first()->get(); //  Mengambil data paket berdasarkan id

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

    public function store(Request $request) // Method create atau menambah data paket
    {
        $storeData = $request->all();    // Mengambil seluruh data input dan menyimpan dalam variabel storeData
        $validate = Validator::make($storeData, [
            'noResi' => 'required',
            'idPengirim' => 'required',
            'idService' => 'required',
            'jenisPaket' => 'required',
            'berat' => 'required',
            'volume' => 'required',
            'namaPenerima' => 'required',
            'noTelpPenerima' => 'required',
            'alamatTujuan' => 'required',
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()], 400);
        
        $paket = Paket::create($storeData); // Menambah data paket baru
        return response([
            'message' => 'Add Paket Success',
            'data' => $paket,
        ], 200); // return data paket yang baru saja ditambahkan dalam bentuk json
    }
    
    public function destroy($id) // Method delete atau menghapus data paket berdasarkan id
    {
        $paket = Paket::where('noResi', '=', $id)->first(); //  Mengambil data paket berdasarkan id

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

    public function update(Request $request, $id) // Method update atau mengubah data paket berdasarkan id
    {
        $paket = Paket::where('noResi', '=', $id)->first(); //  Mengambil data paket berdasarkan id

        if(is_null($paket)){
            return response([
                'message' => 'Paket Not Found',
                'data' => null
            ], 404);
        }

        $updateData = $request->all(); // Mengambil seluruh data input dan menyimpan dalam variabel updateData
        $validate = Validator::make($updateData, [
            'idPengirim' => 'required',
            'jenisPaket' => 'required',
            'idService' => 'required',
            'berat' => 'required',
            'volume' => 'required',
            'namaPenerima' => 'required',
            'noTelpPenerima' => 'required',
            'alamatTujuan' => 'required',
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()], 400);

        $paket->idPengirim = $updateData['idPengirim'];
        $paket->idService = $updateData['idService'];
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
