# Deploy process for Tines.kr

It uses **SSH**. if you don't want to use it, you can do **laravel\envoy** \
<https://laravel.com/docs/5.7/envoy>

<pre>
~/
├── document_root => ~/releases/release_YmdHis
├── releases/
│   └── release_YmdHis
│       ├── .env => ~/shared/.env
│       ├── bootstrap
│       │   └── cache => ~/shared/cache
│       └── storage => ~/shared/storage
└── shared/
    ├── .env
    ├── cache
    └── storage
</pre>

# Before run deploy

You must setting **Laravel\Collective\Remote** SSH connection.

```json
"require": {
    "laravelcollective/remote": "5.4.*"
}
```

<https://laravelcollective.com/docs/5.4/ssh>

# Configuration

|Name|env|default|description|Action|
|----|---|-------|-----------|-------|
|connection|DEPLOY_SSH_CONNECTION|production|Collective\Remote connection in config/remote.php|SSH::into(\<connection\>)->run([...])|
|remote|DEPLOY_REMOTE|null|Github REMOTE URL for 'git clone'|git clone \<remote\>|
|root|DEPLOY_ROOT|~/www|Document Root of web Project on your server|ln -nfs \<releases\>/\<dist\> \<root\>
|shared|DEPLOY_SHARED|~/shared|Shared directory path|cp \<releases\>/\<dist\>/.env.example \<shared\>/.env <br /> cp -R \<releases\>/\<dist\>/storage \<shared\> <br /> cp -R \<releases\>/\<dist\>/bootstrap/cache \<shared\>
|releases|DEPLOY_RELEASES|~/releases|Releases directory path|cd \<releases\> git clone ...
|dist|DEPLOY_DIST|'release_' . date('YmdHis')|Distribution directory name|git clone \<remote\> \<dist\>
|group|DEPLOY_GROUP|www-data|Deployment group|chgrp -h -R \<group\> \<releases\>/\<dist\>

# How to use

```bash
php artisan deploy
```

# Reference

<https://github.com/appkr/l5code/blob/master/envoy.blade.php>