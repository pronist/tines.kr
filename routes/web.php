<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/** 티스토리 로그인 */
Route::group(['middleware' => 'web'], function () {
    /** 티스토리 로그인 */
    Route::group(['prefix' => 'auth'], function () {
        Route::get('/login', 'AuthController@login');
        Route::get('/logout', 'AuthController@logout');
    });
    /** 홈 */
    Route::get('/', 'Home');
    /** 검색 */
    Route::get('/search', 'Search');
    /** 인증이 필요한 구역 */
    Route::group(['middleware' => 'auth:web'], function () {
        /** 구독자 */
        Route::get('/subscribers', 'Subscribers');
        /** 새 글 보기 */
        Route::get('/posts', 'Posts');
        /** 이웃 */
        Route::get('/neighbors', 'Neighbors');
        /** 내 블로그 관리 */
        Route::get('/manage', 'Manage');
        /** 블로그 */
        Route::resource('blogs', 'BlogsController', [
            'only' => ['store', 'destroy']
        ]);
    });
    Route::get('/widget/{component}', 'Widget');
});

