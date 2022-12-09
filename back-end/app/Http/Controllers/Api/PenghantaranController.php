<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Penghantaran;
use Illuminate\Support\Facades\Validator;

class PenghantaranController extends Controller
{
    public function index()
    {
        $penghantaran = Penghantaran::all();

        if(count($penghantaran) > 0){
            return response([
                'message' => 'Retrieve All Success',
                'data' => $penghantaran
            ], 200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ], 400);
    }

    public function show($id)
    {
        $penghantaran = Penghantaran::find($id);

        if(!is_null($penghantaran)){
            return response([
                'message' => 'Retrieve Penghantaran Success',
                'data' => $penghantaran
            ], 200);
        }

        return response([
            'message' => 'Penghantaran Not Found',
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
            'idService' => 'required',
            'status' => 'required',
            'keterangan' => 'required',
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()], 400);

        $penghantaran = Penghantaran::create($storeData);
        return response([
            'message' => 'Add Penghantaran Success',
            'data' => $penghantaran,
        ], 200);
    }

    public function destroy($id)
    {
        $penghantaran = Penghantaran::find($id);

        if(is_null($penghantaran)){
            return response([
                'message' => 'Penghantaran Not Found',
                'data' => null
            ], 404);
        }

        if($penghantaran->delete()){
            return response([
                'message' => 'Delete Penghantaran Success',
                'data' => $penghantaran,
            ], 200);
        }

        return response([
            'message' => 'Delete Penghantaran Failed',
            'data' => null,
        ], 400);
    }

    public function update(Request $request, $id)
    {
        $penghantaran = Penghantaran::find($id);
        if(is_null($penghantaran)){
            return response([
                'message' => 'Penghantaran Not Found',
                'data' => null
            ], 404);
        }
        $updateData = $request->all();
        $validate = Validator::make($updateData, [
            'noResi' => 'required',
            'idKurir' => 'required',
            'idDropPoint' => 'required',
            'idService' => 'required',
            'status' => 'required',
            'keterangan' => 'required',
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()], 400);

        $penghantaran->noResi = $updateData['noResi'];
        $penghantaran->idKurir = $updateData['idKurir'];
        $penghantaran->idDropPoint = $updateData['idDropPoint'];
        $penghantaran->idService = $updateData['idService'];
        $penghantaran->status = $updateData['status'];
        $penghantaran->keterangan = $updateData['keterangan'];
        
        if($penghantaran->save()){
            return response([
                'message' => 'Update Penghantaran Success',
                'data' => $penghantaran,
            ], 200);
        }

        return response([
            'message' => 'Update Penghantaran Failed',
            'data' => null,
        ], 400);

    }
}
