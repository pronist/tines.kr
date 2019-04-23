# 로그인하기

티네스에 로그인하는 방법은 **두 가지**가 있습니다. 첫 번째는 **티네스 서버에 티스토리 로그인을 위임**하는 것이며, 모든 과정을 티네스 서버가 처리합니다. 두 번째는 **티스토리 로그인은 별도의 앱에서 진행**하고, 엑세스 토큰을 넘겨 티네스에서 제공하는 **JWT(Json Web Token)** 토큰만 수령하는 방법입니다.

## JWT(Json Web Token) 

티네스는 **JWT(Json Web Token)** 로 인증합니다. OAuth 인증처럼 복잡한 과정을 거치지 않아도 됩니다. 그저 로그인을 요청하고 토큰을 받으세요. 로그인을 마친 뒤 **JWT(Json Web Token)**을 사용하여 인증이 필요한 기능을 사용하거나, 추가 정보를 얻을 수 있습니다. 참고로 이 토큰은 티스토리 API 에서 발급하는 토큰이 아니므로 사용에 유의하십시오. 발급받은 토큰은 **2시간** 동안만 유효하므로 그 이후가 지나면 다시 인증해야 합니다. 갱신은 제공하지 않습니다.


## 티네스 서버에 티스토리 로그인 위임하기

로그인 요청 URL 은 다음과 같습니다. 여기서 주목해야 할 것은 ```state``` 파라매터인데, 이곳의 옵션에 무엇을 넣느냐에 따라 동작이 변화합니다.

```
https://www.tistory.com/oauth/authorize/
    ?client_id=2985876bbf036691bb3bdb98c1626faf
    &redirect_uri=https%3A%2F%2Ftines.kr%2Fauth%2Flogin
    &response_type=code
    &state=__JSON_STATE_OPTIONS__
```

### Json State Options

|이름|설명|기본값|필수|
|----|----|---|----|
|redirect_uri|로그인을 마친 후 이동할 **URL** 입니다.|/|Y|

### Response

티네스 서버에 티스토리 로그인을 위임하게 되면, 발급받은 **JWT(Json Web Token)**는 ```access_token``` 이라는 이름의 ```get``` 파라매터로 URL주소에 포함됩니다.

## 엑세스 토큰으로 로그인하기

**티스토리 API**를 통해 발급받은 **access_token**으로 직접 자신의 앱에서 로그인을 요청할 수도 있습니다. 요청을 보내기전에, **티스토리 API**에 자신의 앱을 등록하시기 바랍니다.

<https://www.tistory.com/guide/api/manage/register>

### Request

```
POST https://api.tines.kr/v1/auth/login
```

### Parameters

|이름|설명|필수|
|----|----|---|
|access_token|<https://tistory.github.io/document-tistory-apis/auth/authorization_code.html>|Y|


### Response

```json
{
    "token_type": "bearer",
    "access_token": "__JSON_WEB_TOKEN__",
    "expires_in": 7200
}
```

