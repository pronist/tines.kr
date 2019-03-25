<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

use App\Classes\Authentication;

use Tistory\Exceptions\AuthenticationException;

class AuthController extends Controller
{   
    /**
    * Create a new AuthController instance.
    *
    * @return void
    */
    public function __construct()
    {
        $this->middleware('auth:web', ['except' => ['login']]);
    }

    public function login(Request $request, \GuzzleHttp\Client $client)
    {
        /** 요청 매개변수 */
        $code = $request->get('code');
        $state = json_decode($request->get('state'));

        $access_token = null;
        
        if($code) {
            try {
                /** 티스토리 API */
                $access_token = \Tistory\Auth::getAccessToken(
                    env('TISTORY_CLIENT_ID'),
                    env('TISTORY_SECRET_KEY'),
                    env('TISTORY_CALLBACK'),
                    $request->get('code')
                );
            }
            catch(AuthenticationException $e) {
                return response()->json(['message' => $e->getMessage()], 500);
            }
            try {
                $response = $client->request('post', 'auth/login', [
                    'form_params' => [
                        'access_token' => $access_token
                    ]
                ]);

                $response = json_decode($response->getBody()->getContents());

                /**
                 * $response->token: 이 토큰은 JWT 이다.
                 */
                Auth::guard('web')->login(
                    Auth::guard('api')
                        ->setToken($response->token)
                        ->user()
                );

                /** JWT를 세션에 저장합니다. */
                $request->session()->put('token', $response->token);

                /** 티스토리 엑세스토큰을 세션에 저장합니다. */
                $request->session()->put('access_token', $access_token);
                
                /** 세션 시작시간을 저장합니다. */
                $request->session()->put('started', time());

                /** 
                 * 상태 쿼리 옵션
                 * 
                 * 슬프게도 티스토리와 연동하여 로그인 해야 하므로
                 * 모든 web 로그인 요청의 끝은 결국 GET auth/login 으로 도달합니다.
                 * 따라서 해당 컨트롤러에서 모든 것을 처리 해야하고
                 * 그것은 일반적인 로그인 뿐만아니라, 구독 등의 로그인이 별도로 필요한
                 * 행위를 할 때에도 해당 컨트롤러를 거쳐야합니다.
                 * 
                 * 상태 쿼리옵션은 일반적인 로그인의 행동 이후 
                 * 다음(리다이렉트, 구독 등)을 만들어 줄 수 있는 유일한 통로가 됩니다.
                 */

                /** 일반 로그인 이외의 다양한 행동을 취합니다. */
                $type = isset($state->type)? $state->type: '';

                switch($type) {
                    /** 구독을 요청합니다. */
                    case 'subscribe':
                        try {
                            $client->request('post', 'neighbors', [
                                'headers' => [ 
                                    'Authorization' => 'Bearer '. $request->session()->get('token')
                                ],
                                'form_params' => [
                                    'name' => $state->name
                                ]
                            ]);
                            return redirect()->to('/neighbors', 302);
                        }
                        catch(\Exception $e) {
                            /** 예외가 생겨도 어쨋든 리다이렉트 */
                            return redirect()->to('/', 302);
                        }
                    default:
                        break;
                }
                /** 
                 * 엑세스토큰이 붙는 경우는 다른 앱에서
                 * 티네스에 로그인을 요청을 위임한 경우가 됩니다. 
                 */
                $redirect_uri = isset($state->redirect_uri)
                    ? $state->redirect_uri.'?access_token='.$response->token
                    : '/'
                ;
                return redirect()->to($redirect_uri, 302);
            }
            catch(\Exception $e) {
                return response()->json(['message' => $e->getMessage()], 500);
            }
        }
        else {
            return redirect(\Tistory\Auth::getPermissionUrl(
                env('TISTORY_CLIENT_ID'),
                env('TISTORY_CALLBACK')
            ));
        }
    }

    public function logout(Request $request, \GuzzleHttp\Client $client)
    {
        try {
            /** 로그아웃 */
            Authentication::logout($client);

            return redirect('/');
        }           
        catch(\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
