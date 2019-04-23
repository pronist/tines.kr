# 이웃 추가하기

### URL

```
POST https://api.tines.kr/v1/neighbors
```

### Parameters

|이름|설명|기본값|필수|
|----|----|-----|----|
|name|**example**.tistory.com|null|Y|

### Header

이웃을 추가 할 때는 **JWT(Json Web Token)** 값이 필수입니다.

```
Authorization: Bearer __JSON_WEB_TOKEN__
```