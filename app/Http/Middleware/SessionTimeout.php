<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;

use App\Classes\Authentication;

use Closure;

class SessionTimeout
{
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->session()->get('started')) {
            
            /** JWT, 티스토리는 2시간 이후면 토큰이 소멸된다. */
            $expire = 7200; 

            if((time() - $request->session()->get('started') - $expire) > 0) { 
                /** 로그아웃합니다. */
                Authentication::logout($this->client);
            }
        }
        return $next($request);
    }
}
