<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Search extends Controller
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
            $search = $request->get('q');

            if(isset($search)) {
                return view('search', [
                    /** MySQL FULLTEXT Search */
                    'blogs' => \App\Blog::whereRaw('MATCH(nickname, title, url, name) AGAINST(? IN BOOLEAN MODE)', [$search])->get()
                ]);
            }
            else {
                return redirect('/');
            }
        }
        catch(\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
