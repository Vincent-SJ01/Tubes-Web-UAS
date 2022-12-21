<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function index() // Method read atau menampilkan semua data user
    {
        $customers = User::with('role', 'status')->get(); //  Mengambil semua data user

        if(count($customers) > 0){
            return response([
                'message' => 'Retrieve All Success',
                'data' => $customers
            ], 200);
        }// return data semua user dalam bentuk json

        return response([
            'message' => 'Empty',
            'data' => null
        ], 400);    // return message data course kosong
    }

    public function show() // Method read atau menampilkan data user berdasarkan id
    {
        $id = Auth::id(); //  Mengambil id user yang sedang login
        $user = User::with('role', 'status')->where('id', '=', $id)->first(); //  Mengambil data user berdasarkan id

        if(!is_null($user)){
            return response([
                'message' => 'Retrieve Customer Success',
                'data' => $user
            ], 200);
        }// return data user dalam bentuk json

        return response([
            'message' => 'Customer Not Found',
            'data' => null
        ], 404);    // return message data user tidak ditemukan
    }

    public function store(Request $request) // Method create atau menambah data user
    {
        $storeData = $request->all();    // Mengambil seluruh data input dan menyimpan dalam variabel storeData
        $validate = Validator::make($storeData, [
            'nama' => 'required',
            'email' => 'required',
            'password' => 'required',
            'email' => 'required',
            'alamat' => 'required',
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()], 400); // return error validasi

        $user = User::create($storeData); // Menambah data user baru
        
        return response([
            'message' => 'Add Customer Success',
            'data' => $user,
        ], 200); // return data user yang baru saja ditambahkan

    }

    public function destroy($id) // Method delete atau menghapus data user berdasarkan id
    {
        $user = User::where('id', '=', $id)->first(); //  Mengambil data user berdasarkan id

        if(is_null($user)){
            return response([
                'message' => 'Customer Not Found',
                'data' => null
            ], 404); // return message data user tidak ditemukan
        }

        if($user->delete()){
            return response([
                'message' => 'Delete Customer Success',
                'data' => $user,
            ], 200); // return data user yang baru saja dihapus
        }

        return response([
            'message' => 'Delete Customer Failed',
            'data' => null,
        ], 400); // return message data user gagal dihapus
    }

    public function update(Request $request, $id){
        $user = User::where('id', '=', $id)->first(); //  Mengambil data user berdasarkan id

        if(is_null($user)){
            return response([
                'message' => 'User Not Found',
                'data' => null
            ], 404); // return message data user tidak ditemukan
        }

        $updateData = $request->all(); // Mengambil seluruh data input dan menyimpan dalam variabel updateData
        $validate = Validator::make($updateData, [
            'nama' => 'required',
            'password' => 'required',
            'alamat' => 'required',
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()], 400); // return error validasi

        $user->nama = $updateData['nama'];
        $user->password = $updateData['password'];
        $user->alamat = $updateData['alamat'];

        if($user->save()){
            return response([
                'message' => 'Update Customer Success',
                'data' => $user,
            ], 200); // return data user yang baru saja diupdate
        }

        return response([
            'message' => 'Update Customer Failed',
            'data' => null,
        ], 400); // return message data user gagal diupdate
    }

    public function createPDF() {
        // retreive all records from db
        $data = User::all();
  
        // share data to view
        view()->share('user',$data);
        $pdf = PDF::loadView('pdf_view', $data);
  
        // download PDF file with download method
        return $pdf->download('pdf_file.pdf');
      }
}
