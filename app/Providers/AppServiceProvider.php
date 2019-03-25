<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use GuzzleHttp\Client;

class AppServiceProvider extends ServiceProvider
{
    protected $providers = [
        'Barryvdh\Debugbar\ServiceProvider',
        'Collective\Remote\RemoteServiceProvider',
        'Deploy\ServiceProvider'
    ];
    
    protected $aliases = [
        'Debugbar' => 'Barryvdh\Debugbar\Facade',
        'SSH' => 'Collective\Remote\RemoteFacade'
    ];

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(['layouts.app', 'parts.thumbnail'], function($view) {
            /** 기본적으로 인증 가드는 'api' 로 설정되어있다. */
            $view->with('auth', Auth::guard('web'));
        });
        View::composer(['layouts.app'], function($view) {
            /** 블로거 5명을 랜덤으로 불러옵니다. */
            $view->with('recommends', \App\Blog::orderByRaw('rand()')->limit(5)->get());
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        /** register the service providers for local environment */
        if ($this->app->isLocal() && !empty($this->providers)) {
            foreach ($this->providers as $provider) {
                $this->app->register($provider);
            }
            /** register the alias */
            if (!empty($this->aliases)) {
                foreach ($this->aliases as $alias => $facade) {
                    $this->app->alias($alias, $facade);
                }
            }
        }
        $this->app->instance('GuzzleHttp\Client', new Client([
            // Base URI is used with relative requests
            'base_uri' => config('api.url')."/".config('api.version')."/",
            // You can set any number of default request options.
            'timeout'  => 10.0
        ]));
    }
}
