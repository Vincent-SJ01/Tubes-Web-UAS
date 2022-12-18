<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Kurir;
use App\Models\Admin;
class EmailRegisterLoginController extends Controller
{
    public function notice(){
        return response()->json([
            'message' => 'Please verify your email'
        ], 200);
    }

    public function verify(Request $request){
        $user = User::find($request->route('id'));
        $user ->update([
            'email_verified_at' => now()
        ]);

        $kurir = Kurir::find($request->route('id'));
        $kurir ->update([
            'email_verified_at' => now()
        ]);

        $admin = Admin::find($request->route('id'));
        $admin ->update([
            'email_verified_at' => now()
        ]);

        return response()->json([
            'message' => 'Email verfied'
        ], 200);


        
    }
    
    


    
}
