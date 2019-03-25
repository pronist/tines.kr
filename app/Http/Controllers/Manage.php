<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use \App\Classes\Api\v1\Thumbnail;

class Manage extends Controller
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
            $registered = \App\Blog::where('user_id', '=', auth()->user()->id)->get();

            return view('manage', [
                'manage' => array_merge(
                    Thumbnail::get($registered), 
                    Thumbnail::getUnregistered($registered, $request->session()->get('access_token')
                ))
            ]);
        }
        catch(\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
