<?php

namespace App\Http\Controllers\Api\V1;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
//use App\Http\Controllers\Controller;
use App\Models\User;

use App\Transformers\UserTransformer;

class AuthFirstController extends BaseApiController
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

    public function userinfo(){
//        dd($this->auth->user());

//        dd(Auth::guard($this->getGuard())->user()->name);
        $user = User::findOrFail(2);
        $users = User::all();
        //第一种方法
        //return $this->response->array($user->toArray());
        //第二种方法
        //return $this->response->item($user, new UserTransformer);
        //集合写法
        //return $this->response->collection($users, new UserTransformer);
        //分页写法
        $users = User::paginate(2);
//        throw new \Symfony\Component\HttpKernel\Exception\BadRequestHttpException('haha from liuxc');
//        die;
        return $this->response->paginator($users, new UserTransformer());
//        return $this->response->created("https://www.baidu.com");
    }

    //
}
