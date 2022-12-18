<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Verified;
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
        // return $request->route('id');
        if(!$user == null){
            if ($user->hasVerifiedEmail()) {
                return view('emailverified');
            }
            if($user->markEmailAsVerified()) {
                event(new Verified($user));
            }
        }

        $kurir = Kurir::find($request->route('id'));
        // return $kurir;
        if(!$kurir == null){
            if ($kurir->hasVerifiedEmail()) {
                return view('emailverified');
            }
            if($kurir->markEmailAsVerified()) {
                event(new Verified($kurir));
            }
        }

        $admin = Admin::find($request->route('id'));
        // return $kurir;
        if(!$admin == null){
            if ($admin->hasVerifiedEmail()) {
                return view('emailverified');
            }
            if($admin->markEmailAsVerified()) {
                event(new Verified($admin));
            }
        }
        
        return view('emailverify');

        // $kurir = Kurir::find($request->route('id'));
        // $kurir ->update([
        //     'email_verified_at' => now()
        // ]);

        // $admin = Admin::find($request->route('id'));
        // $admin ->update([
        //     'email_verified_at' => now()
        // ]);

        // return response()->json([
        //     'message' => 'Email verfied'
        // ], 200);


        
    }
    
    


    
}
