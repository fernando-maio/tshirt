<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Json
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), array(
                'email' => 'required|email',
                'password' => 'required'
            ));  

        if($validator->fails()) {  
            return response()->json(array(
                'error' => $validator->errors()
            ), 401); 
        }

        $credentials = $this->credentials($request);
        $token = \JWTAuth::attempt($credentials);

        return $this->responseToken($token);
    }

    /**
     * Authentication logout 
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Json
     */
    public function logout(Request $request)
    {
        \Auth::guard('api')->logout();
        
        return response()->json(array(), 204);
    }

    /**
     * Refresh token 
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Json
     */
    public function refresh(Request $request)
    {
        $token = \Auth::guard('api')->refresh();
        
        return $this->responseToken($token);
    }
    
    /**
     * Create a token response
     *
     * @param  string $token
     * @return string
     */
    private function responseToken($token)
    {
        return $token ? array('token' => $token) : response()->json(array(
                'error' => \Lang::get('auth.failed')
            ), 401);
    }
}
