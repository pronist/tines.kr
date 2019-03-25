<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Subscribers extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, \GuzzleHttp\Client $client)
    {
        return requestToApiRoute('subscribers', $client);
    }
}
