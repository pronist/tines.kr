<?php

use GuzzleHttp\Client;

/**
 * Deploy Laravel Project on Server
 */
function deploy()
{
    /** 
     * Calling configuration
     */
    $connection = config('deploy.connection');
    $remote     = config('deploy.remote');
    $root       = config('deploy.root');
    $shared     = config('deploy.shared');
    $releases   = config('deploy.releases');
    $dist       = config('deploy.dist');
    $group      = config('deploy.group');

    $requires = [ $shared, $releases ];

    $shareds = [
        "$shared/.env"    => "$releases/$dist/.env",
        "$shared/storage" => "$releases/$dist/storage",
        "$shared/cache"   => "$releases/$dist/bootstrap/cache"
    ];

    /** 
     * Execute commands over SSH
     */
    (new \App\Classes\Command($connection))
        ->require($requires)
        ->download($releases, $remote, $dist)
        ->copy($shared, $releases, $dist)
        ->shared($shareds)
        ->composer($releases, $dist)
        ->link($releases, $dist, $root)
        ->chmod($shared)
        ->chgrp($group, $releases, $dist)
    ;
}

function getFormattedExceptionMessage($e) 
{
    /** 예외 메시지를 포맷팅 합니다. */
    return $e->getMessage()." in ".$e->getFile().":".$e->getLine();
}

function requestToApiRoute(string $name, \GuzzleHttp\Client $client) 
{
    try {
        /** API 라우터로 요청을 보냅니다. */
        $response = $client->request('get', $name, Auth::guard('web')->check()
        ? [
            'headers' => [
                /** 토큰으로 인증합니다. */
                'Authorization' => 'Bearer '. session()->get('token')
            ],
            'query' => [
                /** 이메일을 파라매터로 조회합니다. */
                'email' => Auth::guard('web')->user()->email
            ]
        ]: []);

        $thumbnails = json_decode($response->getBody()->getContents(), true);

        return view($name, [
            $name => $thumbnails
        ]);
    }
    catch(\Exception $e) {
        return response()->json(['message' => $e->getMessage()], 500);
    }
}