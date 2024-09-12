<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\SessionData;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
class LoginController extends Controller{

    public function login(Request $request){
        $credentials = $request->validate([
            'employe_id' => ['required'],
            'password' => ['required'],
        ]);

        $user = User::where('employe_id', $request->employe_id)->first();
        if(isset($user) && $user->status==0){
            return back()->with('error', 'Your Account has been deactivated Contact your administrator.');
        }

        if (Auth::attempt($credentials)) {
            return redirect()->intended('/chatify');
        }
        return back()->with('error', 'The provided credentials do not match our records.');
    }

}

