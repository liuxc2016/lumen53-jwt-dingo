<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function login(Request $request){
        $credentials = $request->only(['email', 'password']);
        $token = Auth::guard($this->getGuard())->attempt($credentials);
        if ($token) {
            return response()->json([
                'token'=>$token,
                'code' => 200
            ], 200);
        }else{
            return response()->json([
                'error'=>'invalid email or password',
                'code' => 1003
            ], 401);
        }
    }

    public function getGuard(){
        return 'api';
    }

    //
}
