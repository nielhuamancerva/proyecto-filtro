<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class RegisterController extends Controller
{
    public function register(Request $request){
        $this->validate($request, [
            'name' => "required|min:3",
            'email' => "required|email|unique:users",
            'password' => "required|min:6",
        ]);
 
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
 
        $token = $user->createToken('auth-token')->accessToken;
 
        return response()->json(['token' => $token], 200);
    }
}
