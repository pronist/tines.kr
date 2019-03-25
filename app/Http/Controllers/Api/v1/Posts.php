<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;

use \App\Classes\Api\v1\Post;

class Posts extends \App\Http\Controllers\Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
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
            
            return response()->json(
                Post::get(
                    /** 이웃의 블로그로부터 3일이내의 글을 얻어옵니다. */
                    auth()->user()->neighbors()->get(),
                    $start,
                    $count
                )
            , 200);
        }
        catch(\Exception $e) {
            return response()->json(['message' => 'Bad Request'], 400);
        }
    }
}
