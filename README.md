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

<https://github.com/pronist/tines.kr/wiki>

### Authentication

|Name|Description|Method|
|----|-----------|------|
[/v1/auth/login](https://github.com/pronist/tines.kr/wiki/Authentication#login)|Sign in|POST
[/v1/auth/logout](https://github.com/pronist/tines.kr/wiki/Authentication#logout)|Sign out|GET

### Blog

|Name|Description|Method|
|----|-----------|------|
[/v1/blogs](https://github.com/pronist/tines.kr/wiki/Blog#get-blogs)|Get registered blogs|GET

### Neighbor

|Name|Description|Method|
|----|-----------|------|
[/v1/neighbors](https://github.com/pronist/tines.kr/wiki/Neighbor#get-neighbors)|Get neighbors|GET
[/v1/neighbors](https://github.com/pronist/tines.kr/wiki/Neighbor#append-a-new-neighbor)|Append a new neighbor|POST
[/v1/neighbors/{name}](https://github.com/pronist/tines.kr/wiki/Neighbor#remove-a-neighbor)|Remove a neighbor|DELETE

### Post

|Name|Description|Method|
|----|-----------|------|
[/v1/posts](https://github.com/pronist/tines.kr/wiki/Post#get-posts-in-3-days)|Get posts in 3 days|GET

### Subscriber

|Name|Description|Method|
|----|-----------|------|
[/v1/subscribers](https://github.com/pronist/tines.kr/wiki/subscriber#get-subscribers)|Get subscribers|GET|

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
