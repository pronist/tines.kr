<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;

use \App\Classes\Api\v1\Thumbnail;

class Subscribers extends \App\Http\Controllers\Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        try {
            /** 요청 매개변수 */
            $count = $request->get('count')?: config('api.count');
            $start = $request->get('start')?: config('api.start');
            $email = $request->get('email');

            if($email) {
                /** 구독자 */
                $subscribers = [];
                /** 내 블로그를 얻어옵니다. */
                foreach(\App\User::where('email', '=', $email)->first()->blogs()->get() as $blog) {
                    /** 주어진 요청변수에 따라 구독자를 얻어옵니다. */
                    foreach($blog->subscribers()->limit($count)->offset($start)->get() as $blogger) {
                        $user = $blogger->blogs()->where('default', '=', '1')->first();
                        if(!in_array($user, $subscribers)) {
                            /** 첫번째 블로그를 표시합니다. */
                            array_push($subscribers, $user);
                        }
                    }
                }
                return response()->json(Thumbnail::get($subscribers), 200);
            }
            else {
                return response()->json(['message' => 'Please check request parameters'], 400);
            }
        }
        catch(\Exception $e) {
            return response()->json(['message' => 'Bad request'], 400);
        }
    }
}
