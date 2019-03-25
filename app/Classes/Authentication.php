<?php

namespace App\Classes;

use Tistory\Exceptions\AuthenticationException;
use Tistory\Exceptions\BadResponseException;

use Illuminate\Support\Facades\Auth;

class Authentication
{
    public static function logout(\GuzzleHttp\Client $client)
    {
        /** 로그아웃합니다. */
        Auth::guard('web')->logout();

        $client->request('get', 'auth/logout', [
            'headers' => [
                'Authorization' => 'Bearer '. session()->get('token')
            ]
        ]);

        /** 저장된 토큰을 날립니다. */
        session()->remove('token');
        session()->remove('access_token');

        /** 저장된 세션 시작시간을 날립니다. */
        session()->remove('started');
    }
}