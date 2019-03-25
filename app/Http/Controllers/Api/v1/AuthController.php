<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;

use App\Classes\Api\v1\Authentication;

class AuthController extends \App\Http\Controllers\Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function login(Request $request)
    {
        try {
            /** 
             * 요청 매개변수 
             * 
             * access_token: 티스토리 엑세스 토큰임을 주의하자
             */
            $access_token = $request->get('access_token');

            /** 로그인 요청 */
            return $access_token
                ? Authentication::login($access_token)
                : response()->json([
                    'message' => 'Please check request parameters'
                ], 400)
            ;
        }
        catch(\Exception $e) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    }

    public function logout()
    {
        try {
           /** 로그아웃 */
           auth()->logout();
            
            return response()->json([], 200);
        }
        catch(\Exception $e) {
            return response()->json(['message' => 'Bad Request'], 400);
        }
    }
}
