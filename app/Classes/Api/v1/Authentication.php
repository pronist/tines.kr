<?php

namespace App\Classes\Api\v1;

use Tistory\Exceptions\AuthenticationException;
use Tistory\Exceptions\BadResponseException;

use Illuminate\Support\Facades\Config;

use \App\Classes\Api\v1\Thumbnail;

class Authentication
{
    private static function createNewUser($user)
    {
        /** 새 유저 생성 */
        $newUser = \App\User::create([
            'email'  => $user->id,
            'userId' => $user->userId
        ]);
        /** 대표 블로그만 등록합니다. */
        foreach($user->blogs as $blog) {
            if($blog['default'] == 'Y') {
                Thumbnail::build((object) $blog, $newUser->blogs(), 'create');
                break;
            }
        }
        return $newUser;
    }

    public static function login($access_token)
    {
        $user = null;

        /** 유저 블로그 정보를 얻어옵니다. */
        try {
            $user = \Pronist\Tistory\Blog::info($access_token);
        }
        catch(BadResponseException $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
        try {
            /** 기존 유저인가요? */
            $currentUser = \App\User::where('email', '=', $user->id)->first()?: null;

            /**
            * 새로운 유저인 경우 대표 블로그만 추가하고
            * 기존 유저인 경우 블로그의 정보를 갱신합니다.
            */
            if(!$currentUser) {
                /** 새 유저 생성 */
                $currentUser = Authentication::createNewUser($user);
            }
            else {
                /** 서비스에 등록된 모든 블로그의 정보를 갱신합니다. */
                foreach($user->blogs as $blog) {
                    /** 현재 유저가 해당 블로그를 등록했습니까? */
                    $registerd = $currentUser->blogs()->where('name', '=', $blog['name'])->first();
                    if($registerd) {
                        Thumbnail::build((object) $blog, $registerd, 'update');
                    }
                }
            }

            /** api 로그인 */
            $token = auth()->claims(['access_token' => $access_token])->login($currentUser);

            return response()->json([
                'token' => $token,
                'token_type' => 'bearer',
                'expires_in' => auth()->factory()->getTTL() * 60
            ], 201);
        }
        catch(\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
