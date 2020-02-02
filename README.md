# Tistory Neighbor Service (Tines)

**Tistory Neighbor Service** is a Community system for *Tistory* that is korean blogging service. \
if you use this service, you can connection to *Tistory* bloggers.

This service is not served now. *Tistory* have been presented community system.

- 2018/11 - 2019/01

## Features

- Login with **Tistory API**
- **Neighbor Service** (Subscribe) between Tistory Bloggers
- Check **new articles** in 3 days
- **[Widget](https://github.com/pronist/tines.kr/tree/master/resources/js/widget)** for Neighbor Connection and Subscribe

## Tines API

**[Tines API](https://github.com/pronist/tines.kr/wiki)** services are for Developers. If you use Tines API, you can get informations about **Tines**. User Authentication; **Login and Logout**, Informations; **Blogs, Subscribers, Neighbors**. but, **This API is not served now**.

## Deploy

It uses **SSH**. if you don't want to use it, you can do **laravel\envoy** \
<https://laravel.com/docs/5.7/envoy>

```
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
```

### Before run deploy

You must setting **Laravel\Collective\Remote** SSH connection.

```json
"require": {
    "laravelcollective/remote": "5.4.*"
}
```

<https://laravelcollective.com/docs/5.4/ssh>

### Configuration

|Name|env|default|description|Action|
|----|---|-------|-----------|-------|
|connection|DEPLOY_SSH_CONNECTION|production|Collective\Remote connection in config/remote.php|SSH::into(\<connection\>)->run([...])|
|remote|DEPLOY_REMOTE|null|Github REMOTE URL for 'git clone'|git clone \<remote\>|
|root|DEPLOY_ROOT|~/www|Document Root of web Project on your server|ln -nfs \<releases\>/\<dist\> \<root\>
|shared|DEPLOY_SHARED|~/shared|Shared directory path|cp \<releases\>/\<dist\>/.env.example \<shared\>/.env <br /> cp -R \<releases\>/\<dist\>/storage \<shared\> <br /> cp -R \<releases\>/\<dist\>/bootstrap/cache \<shared\>
|releases|DEPLOY_RELEASES|~/releases|Releases directory path|cd \<releases\> git clone ...
|dist|DEPLOY_DIST|'release_' . date('YmdHis')|Distribution directory name|git clone \<remote\> \<dist\>
|group|DEPLOY_GROUP|www-data|Deployment group|chgrp -h -R \<group\> \<releases\>/\<dist\>

## License

[MIT](https://github.com/pronist/tines/blob/master/LICENSE)

Copyright 2018-2019. [SangWoo Jeong](https://github.com/pronist). All rights reserved.
