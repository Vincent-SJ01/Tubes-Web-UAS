<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengantaran;
use Illuminate\Support\Facades\Validator;

class PengantaranController extends Controller
{
    public function index()
    {
        $pengantaran = Pengantaran::with('paket', 'kurir', 'dropPoint')->get();

        if(count($pengantaran) > 0){
            return response([
                'message' => 'Retrieve All Success',
                'data' => $pengantaran
            ], 200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ], 400);
    }

    public function show($id)
    {
        $pengantaran = Pengantaran::with('paket', 'kurir', 'dropPoint')->where('noResi','=',$id)->first();

        if(!is_null($pengantaran)){
            return response([
                'message' => 'Retrieve Pengantaran Success',
                'data' => $pengantaran
            ], 200);
        }

        return response([
            'message' => 'Pengantaran Not Found',
            'data' => null
        ], 404);
    }

    public function store(Request $request)
    {
        $storeData = $request->all();
        $validate = Validator::make($storeData, [
            'noResi' => 'required',
            'idKurir' => 'required',
            'idDropPoint' => 'required',
            'status' => 'required',
            'keterangan' => 'required',
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()], 400);

        $pengantaran = Pengantaran::create($storeData);
        return response([
            'message' => 'Add Pengantaran Success',
            'data' => $pengantaran,
        ], 200);
    }

    public function destroy($id)
    {
        $pengantaran = Pengantaran::where('noResi','=',$id)->first();

        if(is_null($pengantaran)){
            return response([
                'message' => 'Pengantaran Not Found',
                'data' => null
            ], 404);
        }

        if($pengantaran->delete()){
            return response([
                'message' => 'Delete Pengantaran Success',
                'data' => $pengantaran,
            ], 200);
        }

        return response([
            'message' => 'Delete Pengantaran Failed',
            'data' => null,
        ], 400);
    }

    public function update(Request $request, $id)
    {
        $pengantaran = Pengantaran::where('noResi','=',$id)->first();
        if(is_null($pengantaran)){
            return response([
                'message' => 'Pengantaran Not Found',
                'data' => null
            ], 404);
        }
        $updateData = $request->all();
        $validate = Validator::make($updateData, [
            'noResi' => 'required',
            'idKurir' => 'required',
            'idDropPoint' => 'required',
            'status' => 'required',
            'keterangan' => 'required',
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()], 400);

        $pengantaran->noResi = $updateData['noResi'];
        $pengantaran->idKurir = $updateData['idKurir'];
        $pengantaran->idDropPoint = $updateData['idDropPoint'];
        $pengantaran->status = $updateData['status'];
        $pengantaran->keterangan = $updateData['keterangan'];
        
        if($pengantaran->save()){
            return response([
                'message' => 'Update Pengantaran Success',
                'data' => $pengantaran,
            ], 200);
        }

        return response([
            'message' => 'Update Pengantaran Failed',
            'data' => null,
        ], 400);

    }
}
