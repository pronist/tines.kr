<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use \App\Classes\Api\v1\Thumbnail;

class NeighborsController extends \App\Http\Controllers\Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => 'index']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, \GuzzleHttp\Client $client)
    {
        try {
            /** 요청 매개변수 */
            $count = $request->get('count')?: config('api.count');
            $start = $request->get('start')?: config('api.start');
            $email = $request->get('email');

            if($email) {
                return response()->json(
                    Thumbnail::get(
                        /** 로그인한 유저의 이웃 블로그를 얻어옵니다. */
                        \App\User::where('email', '=', $email)->first()->neighbors()->limit($count)->offset($start)->get()
                    ), 
                200);
            }
            else {
                return response()->json(['message' => 'Please check request parameters'], 400);
            }
        }
        catch(\Exception $e) {
            return response()->json(['message' => 'Bad Request'], 400);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $user = auth()->user();
            $blog_id = \App\Blog::where('name', '=', $request->post('name'))->first()->id;
    
            /** 자기블로그 추가를 막습니다. */
            if(\App\Blog::where('user_id', '=', $user->id)->where('id', '=', $blog_id)->first()) {
                return response()->json(['message' => 'Cannot append my own blog'], 400);
            }
            else {
                /** 이웃을 추가합니다. */
                \App\Neighbor::create([
                    'user_id' => $user->id,
                    'blog_id' => $blog_id
                ]);
                return response()->json([], 201);
            }
        }
        catch(\Exception $e) {
            return response()->json(['message' => 'Bad Request'], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $name
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $name)
    {
        try {
            $id = \App\Blog::where('name', '=', $name)->first()->id;

            /** 
             * 이웃을 삭제합니다. 
             */
            auth()->user()->neighbors()->detach($id);
    
            return response()->json([], 204);
        }
        catch(\Exception $e) {
            return response()->json(['message' => 'Bad Request'], 400);
        }
    }
}
