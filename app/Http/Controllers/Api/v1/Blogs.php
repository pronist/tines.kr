<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;

use \App\Classes\Api\v1\Thumbnail;

class Blogs extends \App\Http\Controllers\Controller
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
            $name = $request->get('name');

            return response()->json(
                Thumbnail::get(
                    $name
                        /** 단일 블로그를 얻어옵니다. */
                        ? \App\Blog::where('name', '=', $name)->get()
                        /** 블로그 목록을 얻어옵니다. */
                        : \App\Blog::orderByDesc('user_id')->limit($count)->offset($start)->get()
                ), 200);
        }
        catch(\Exception $e) {
            return response()->json(['message' => 'Bad Request'], 400);
        }
    }
}
