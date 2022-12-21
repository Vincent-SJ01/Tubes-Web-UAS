<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{
    public function index()
    {
        $admin = Admin::all();

        if(count($admin) > 0){
            return response([
                'message' => 'Retrieve All Success',
                'data' => $admin
            ], 200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ], 400);
    }

    public function show()
    {
        $id = Auth::id();
        $admin = Admin::find($id);

        if(!is_null($admin)){
            return response([
                'message' => 'Retrieve Admin Success',
                'data' => $admin
            ], 200);
        }

        return response([
            'message' => 'Admin Not Found',
            'data' => null
        ], 404);
    }

    public function store(Request $request)
    {
        $storeData = $request->all();
        $validate = Validator::make($storeData, [
            'username' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()], 400);

        $admin = Admin::create($storeData);

        return response([
            'message' => 'Add Admin Success',
            'data' => $admin,
        ], 200);
    }

    public function destroy($id)
    {
        $admin = Admin::find($id);

        if(is_null($admin)){
            return response([
                'message' => 'Admin Not Found',
                'data' => null
            ], 404);
        }

        if($admin->delete()){
            return response([
                'message' => 'Delete Admin Success',
                'data' => $admin,
            ], 200);
        }

        return response([
            'message' => 'Delete Admin Failed',
            'data' => null,
        ], 400);
    }

}
