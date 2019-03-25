<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Collective\Remote connection in config/remote.php
    |--------------------------------------------------------------------------
    |
    | SSH::into(<connection>)->run([...])
    |
    */

    'connection' => env('DEPLOY_SSH_CONNECTION', 'production'),

    /*
    |--------------------------------------------------------------------------
    | Github REMOTE URL for 'git clone' 
    |--------------------------------------------------------------------------
    |
    | git clone <remote>
    |
    */

    'remote' => env('DEPLOY_REMOTE', '~/.git'),

    /*
    |--------------------------------------------------------------------------
    | Document Root of web Project on your server
    |--------------------------------------------------------------------------
    |
    | ln -nfs <releases>/<dist> <root>
    |
    */

    'root' => env('DEPLOY_ROOT', '~/www'),


    /*
    |--------------------------------------------------------------------------
    | Shared directory path 
    |--------------------------------------------------------------------------
    |
    | .env.example, storage and bootstrap/cache will be copied to shared directory
    | 
    |  cp <releases>/<dist>/.env.example <shared>/.env
    |  cp -R <releases>/<dist>/storage <shared>
    |  cp -R <releases>/<dist>/bootstrap/cache <shared>
    */

    'shared' => env('DEPLOY_SHARED', '~/shared'),

    /*
    |--------------------------------------------------------------------------
    | Releases directory path 
    |--------------------------------------------------------------------------
    |
    | The projects that are copid from 'git' will be in this directory
    |
    | cd <releases> git clone ...
    */

    'releases' => env('DEPLOY_RELEASES', '~/releases'),

    /*
    |--------------------------------------------------------------------------
    | Distribution directory name
    |--------------------------------------------------------------------------
    |
    | The projects that are copid from 'git' will be in this directory
    |
    | git clone <remote> <dist>
    */

    'dist' => env('DEPLOY_DIST', 'release_' . date('YmdHis')),

    /*
    |--------------------------------------------------------------------------
    | Deployment group
    |--------------------------------------------------------------------------
    |
    | chgrp -h -R <group> <releases>/<dist>
    */

    'group' => env('DEPLOY_GROUP', 'www-data')
];