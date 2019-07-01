# 로그아웃 하기

로그아웃 요청을 보내기전에 먼저 유효한 **JWT(Json Web Token)**가 준비되어 있어야합니다.

### URL

```
GET https://api.tines.kr/v1/auth/logout
```

### Header

따로 파라매터는 받지 않지만, ```header``` 에 **JWT(Json Web Token)**를 넣어서 같이 보내야합니다. 예를 들면 다음과 같이 말이죠. ```__JSON_WEB_TOKEN__``` 부분에는 발급받은 토큰이 들어가야합니다.

```
Authorization: Bearer __JSON_WEB_TOKEN__
```