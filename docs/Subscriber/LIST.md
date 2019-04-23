# 구독자 조회하기

### URL

```
GET https://api.tines.kr/v1/subscribers
```

### Parameters

|이름|설명|기본값|필수|
|----|----|-----|----|
|email|구독자를 조회할 유저의 **이메일 주소**|null|Y|
|start|구독자를 몇 번째부터 조회할까요?|0|N|
|count|몇 명의 구독자를 조회할까요?|9|N|

### Response

응답은 JSON 형태로 나타나며 다음과 같은 요소가 담겨있습니다.

|이름|설명|
|----|----|
|id|티네스에 등록된 블로그의 **id**|
|profileImageUrl|대표이미지 **URL**|
|nickname|블로거의 **닉네임**|
|name|**example**.tistory.com|
|url|블로그 **URL**|
|title|블로그의 **이름**|
|description|블로그 **설명**|
|default|**대표블로그** 여부|

```json
[
    { 
        "id": "1",
        "profileImageUrl": "https://tistory4.daumcdn.net/tistory/2710108/attach/a0d6758379f54b41a631b44751a11980",
        "nickname": "앱작가",
        "name": "appwriter",
        "url": "https://appwriter.tistory.com",
        "title": "전생했더니 개발자였던 건에 관하여",
        "description": "신나게 놀고먹고있는 23살 백수 개발자. 티스토리를 위한 티도리 프레임워크(https://tidory.co",
        "default": "1"
    }
    // ...
]
```