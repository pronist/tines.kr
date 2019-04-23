# 이웃 삭제하기

### URL

```
DELETE https://api.tines.kr/v1/neighbors/{name}
```

### Parameters

|이름|설명|기본값|필수|
|----|----|-----|----|
|name|**example**.tistory.com|null|Y|


### Header

이웃을 삭제 할 때는 **JWT(Json Web Token)** 값이 필수입니다.

```
Authorization: Bearer __JSON_WEB_TOKEN__
```