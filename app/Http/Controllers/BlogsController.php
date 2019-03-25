<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use \App\Classes\Api\v1\Thumbnail;
use \App\Classes\Api\v1\Authentication;

class BlogsController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $unregistered = Thumbnail::getUnregistered(
                \App\Blog::where('user_id', '=', auth()->user()->id)->get(), 
                $request->session()->get('access_token')
            );
            foreach($unregistered as $blog) {
                if($blog['name'] == $request->post('name')) {
                    Thumbnail::build((object) $blog, Auth::guard('web')->user()->blogs(), 'create');
                }
            }
            return response()->json([], 201);
        }
        catch(\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
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
            $registered = \App\Blog::where('user_id', '=', auth()->user()->id)->get();

            /** 대표 블로그는 삭제할 수 없습니다. */
            if(\App\Blog::where('name', '=', $name)->first()->default == '1') {
                return response()->json(['message' => 'Cannot remove default blog'], 400);
            }
            foreach($registered as $blog) {
                if($blog->name == $name) {
                    auth()->user()->blogs()->where('name', '=', $name)->delete();
                    return response()->json([], 204);
                }
            }
        }
        catch(\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
