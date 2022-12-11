<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Kurir;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Mail;
use App\Mail\LoginMail;
use App\Mail\RegisterMail;

class AuthController extends Controller
{
    public function registerUser(Request $request){
        $registrationData = $request->all();    // Mengambil seluruh data input dan menyimpan dalam variabel registratinoData
         $validate = Validator::make($registrationData, [
            'nama' => 'required',
            'username' => 'required|unique:users|unique:kurirs|unique:admins', 
            'password' => 'required',
            'email' => 'required|email:rfc,dns|unique:users|unique:kurirs',
            'alamat' => 'required'
            
         ]);    // rule validasi input saat register

         if($validate->fails())    // Mengecek apakah inputan sudah sesuai dengan rule validasi
            return response(['message' => $validate->errors()], 400);   // Mengembalikan error validasi input

        $registrationData['password'] = bcrypt($request->password); // Untuk meng-enkripsi password

        $user = User::create($registrationData);    // Membuat user baru

        return response([
            'message' => 'Register Success',
            'user' => $user
        ], 200); // return data user dalam bentuk json

        // try {
        //     //Mengisi variabel yang akan ditampilkan pada view mail
        //     $content = [
        //         'body' => $request->nama,
        //     ];

        //     //Mengirim email ke emailtujuan@gmail.com
        //     Mail::to('???.id@gmail.com')->send(new LoginMail($content));

        //     //Redirect jika berhasil mengirim email
        //     return redirect()->route('register.index')->with(['success' => 'Data Berhasil Disimpan, email telah terkirim!']);
        // } catch (Exception $e) {
        //     //Redirect jika gagal mengirim email
        //     return redirect()->route('register.index')->with(['success' => 'Data Berhasil Disimpan, namun gagal mengirim email!']);
        // }

    }

    public function registerKurir(Request $request){
        $registrationData = $request->all();    // Mengambil seluruh data input dan menyimpan dalam variabel registratinoData
        $validate = Validator::make($registrationData, [
            'nama' => 'required',
            'username' => 'required|unique:users|unique:kurirs', 
            'password' => 'required',
            'email' => 'required|email:rfc,dns|unique:users|unique:kurirs',
            'alamat' => 'required',
            'nik' => 'required',
            'noTelp' => 'required',
            'tanggalLahir' => 'required',
            'gender' => 'required',
            'status' => 'required'
            
         ]);    // rule validasi input saat register

         if($validate->fails())    // Mengecek apakah inputan sudah sesuai dengan rule validasi
            return response(['message' => $validate->errors()], 400);   // Mengembalikan error validasi input

        $registrationData['password'] = bcrypt($request->password); // Untuk meng-enkripsi password

        $kurir = Kurir::create($registrationData);    // Membuat user baru

        return response([
            'message' => 'Register Success',
            'user' => $kurir
        ], 200); // return data user dalam bentuk json

    }

    public function registerAdmin(Request $request){
        $registrationData = $request->all();    // Mengambil seluruh data input dan menyimpan dalam variabel registratinoData
        $validate = Validator::make($registrationData, [
            'nama' => 'required',
            'username' => 'required|unique:users|unique:kurirs|unique:admins', 
            'password' => 'required',
            'email' => 'required|email:rfc,dns|unique:users|unique:kurirs|unique:admins',
            
         ]);    // rule validasi input saat register

         if($validate->fails())    // Mengecek apakah inputan sudah sesuai dengan rule validasi
            return response(['message' => $validate->errors()], 400);   // Mengembalikan error validasi input

        $registrationData['password'] = bcrypt($request->password); // Untuk meng-enkripsi password

        $admin = Admin::create($registrationData);    // Membuat user baru

        return response([
            'message' => 'Register Success',
            'user' => $admin
        ], 200); // return data user dalam bentuk json

    }

    public function login (Request $request){
        $loginData = $request->all();
        $status = 0;
 
        $validate = Validator::make($loginData, [
            'email' => 'required|email:rfc, dns',
            'password' => 'required'
        ]);

        if($validate->fails())    // Mengecek apakah inputan sudah sesuai dengan rule validasi
            return response(['message' => $validate->errors()], 400);   // Mengembalikan error validasi input

        if(Auth::guard('web')->attempt($loginData)){    // Mengecek apakah inputan sudah sesuai dengan rule validasi
            $status = 1;
            $user = Auth::user();
        }else 
        if(Auth::guard('kurirs-web')->attempt($loginData)){    // Mengecek apakah inputan sudah sesuai dengan rule validasi
            $status = 1;
            $user = Auth('kurirs-web')->user();
        }
        if(Auth::guard('admins-web')->attempt($loginData)){    // Mengecek apakah inputan sudah sesuai dengan rule validasi
            $status = 1;
            $user = Auth('admins-web')->user();
        }

        if($status == 1){
            
            $token = $user->createToken('Authentication Token')->accessToken;   //generate token

            return response([
                'message' => 'Authenticated',
                'user' => $user,
                'token_type' => 'Bearer',
                'access_token' => $token,
            ]); // return data user dan token dalam bentuk json
        }else{
            return response(['message' => 'Invalid Credentials user'], 401);  // Mengembalikan error gagal login
        }

        // try {
        //     //Mengisi variabel yang akan ditampilkan pada view mail
        //     $content = [
        //         'body' => $request->nama,
        //     ];

        //     //Mengirim email ke emailtujuan@gmail.com
        //     Mail::to('???.id@gmail.com')->send(new LoginMail($content));

        //     //Redirect jika berhasil mengirim email
        //     return redirect()->route('login.index')->with(['success' => 'Data Berhasil Disimpan, email telah terkirim!']);
        // } catch (Exception $e) {
        //     //Redirect jika gagal mengirim email
        //     return redirect()->route('login.index')->with(['success' => 'Data Berhasil Disimpan, namun gagal mengirim email!']);
        // }

    }

    public function loginUser (Request $request){
        $loginData = $request->all();
 
        $validate = Validator::make($loginData, [
            'email' => 'required|email:rfc, dns',
            'password' => 'required'
        ]);

        if($validate->fails())    // Mengecek apakah inputan sudah sesuai dengan rule validasi
            return response(['message' => $validate->errors()], 400);   // Mengembalikan error validasi input

        if(!Auth::guard('web')->attempt($loginData)){    // Mengecek apakah inputan sudah sesuai dengan rule validasi
            return response(['message' => 'Invalid Credentials user'], 401);   // Mengembalikan error gagal login
        }
        $user = Auth::user();
        $token = $user->createToken('Authentication Token')->accessToken;   //generate token

        return response([
            'message' => 'Authenticated',
            'user' => $user,
            'token_type' => 'Bearer',
            'access_token' => $token
        ]); // return data user dan token dalam bentuk json

    }

    public function logoutUser(Request $request){
        $user = Auth::user()->token();
        $dataUser = Auth::user();
        $user->revoke();
        return response([
            'message' => 'Logout Succes',
            'user' => $dataUser
        ]);
    }

    public function logoutKurir(Request $request){
        $kurir = Auth::kurir()->token();
        $dataKurir = Auth::kurir();
        $kurir->revoke();
        return response([
            'message' => 'Logout Succes',
            'user' => $dataKurir
        ]);
    }

    public function verifyAccount($token)
    {
        $verifyUser = UserVerify::where('token', $token)->first();
  
        $message = 'Sorry your email cannot be identified.';
  
        if(!is_null($verifyUser) ){
            $user = $verifyUser->user;
              
            if(!$user->is_email_verified) {
                $verifyUser->user->is_email_verified = 1;
                $verifyUser->user->save();
                $message = "Your e-mail is verified. You can now login.";
            } else {
                $message = "Your e-mail is already verified. You can now login.";
            }
        }
  
      return redirect()->route('login')->with('message', $message);
    }
}
