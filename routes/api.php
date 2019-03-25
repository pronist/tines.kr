<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'api', 'namespace' => 'Api'], function () {
    /** API 서비스로 제공 */
    Route::group(['domain' => env('APP_API_URL')], function () {
        Route::group(['prefix' => 'v1', 'namespace' => 'v1', 'middleware' => 'cors'], function () {
            /** 인증 */
            Route::group(['prefix' => 'auth'], function () {
                /** 로그인 */
                Route::post('/login', 'AuthController@login');
                /** 로그아웃 */
                Route::get('/logout', 'AuthController@logout');
            });
            /** 이웃 찾기 */
            Route::get('/blogs', 'Blogs');
            /** 구독자 */
            Route::get('/subscribers', 'Subscribers');
            /** 새 글 보기 */
            Route::get('/posts', 'Posts');
            /** 이웃 */
            Route::resource('neighbors', 'NeighborsController', [
                'only' => ['index', 'store', 'destroy']
            ]);
        });
    });
});