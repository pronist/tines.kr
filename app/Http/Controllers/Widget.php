<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Widget extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, $component)
    {
        try {
            switch($component) {
                case 'subscribe':
                case 'neighbor-connector':
                    return view('widget', [
                        'component'     => $component,
                        'email'         => \App\Blog::where('name', '=', $request->get('name'))->first()->user()->first()->email,
                        'name'          => $request->get('name'),
                        'message'       => $request->get('message')
                    ]);
                    break;
                default:
                    return response()->json(['message' => 'Bad Request'], 400);
            }
        }
        catch(\Exception $e) {
            return response()->json(['message' => 'Bad Request'], 400);
        }
    }
}
