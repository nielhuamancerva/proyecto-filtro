<?php

namespace App\Http\Controllers\Login;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function login(Request $request){
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
         ];
 
         if(auth()->attempt($credentials)){
             $token = auth()->user()->createToken('auth-token')->accessToken;
             return response()->json(['success'=>'true','message'=>'informacion provided','Body'=>['user'=>Auth::user(),'auth_token' => $token]], 200);
         }else{
             return response()->json(['success'=>'false','message'=>'UnAuthorized Llego','Body' => []], 401);
         }
    }
    public function logout(Request $request)
    {
        if (Auth::check()) {
            Auth::user()->AauthAcessToken()->delete();
         }
    return response()->json('logout successful', 201);
    }
    public function botones(Request $request){

        
        $id=$request->id;
        $user = DB::table('personal_access_tokens')->where('tokenable_id','=',$id)->select('abilities')->get();

    return response()->json($user);
    }

 
}
