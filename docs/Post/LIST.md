# 3일 이내의 글 조회하기

**3일 이내의 글**이란 해당 유저가 구독하고 있는 이웃이 쓴 글중 3일 이내의 글을 조회하는 것을 말합니다. 유저가 쓴 글이 아닌 **유저의 이웃이 쓴 글**임을 주의하십시오.

### URL

```
GET https://api.tines.kr/v1/posts
```

### Parameters

|이름|설명|기본값|필수|
|----|----|-----|----|
|start|3일 이내의 글 몇 번째부터 조회할까요?|0|N|
|count|3일 이내의 글을 몇 개를 조회할까요?|9|N|

### Header

**3일 이내의 글 조회**에서는 **필수**로 ```header``` 에 **JWT(Json Web Token)**를 넣어서 같이 보내야합니다. ```__JSON_WEB_TOKEN__``` 부분에는 발급받은 토큰이 들어가야합니다.

```
Authorization: Bearer __JSON_WEB_TOKEN__
```

### Response

응답은 JSON 형태로 나타나며 다음과 같은 요소가 담겨있습니다.

|이름|설명|
|----|----|
|id|포스트 **id**|
|title|포스트 **제목**|
|url|포스트 **URL**|
|date|포스트 **작성일자**|
|blogger|**블로거 정보**가 들어있는 배열|
|blogger.id|티네스에 등록된 블로그의 **id**|
|blogger.profileImageUrl|대표이미지 **URL**|
|blogger.nickname|블로거의 **닉네임**|
|blogger.name|**example**.tistory.com|
|blogger.url|블로그 **URL**|
|blogger.title|블로그의 **이름**|
|blogger.description|블로그 **설명**|
|blogger.default|**대표블로그** 여부|

```json
[
    { 
        "id": "133",
        "title": "티스토리 이웃 서비스, 티네스(Tines)를 소개합니다.",
        "url": "https://appwriter.tistory.com/133",
        "date": "2018.10.25 19:44",
        "blogger": {
            "id": "1",
            "profileImageUrl": "https://tistory4.daumcdn.net/tistory/2710108/attach/a0d6758379f54b41a631b44751a11980",
            "nickname": "앱작가",
            "name": "appwriter",
            "url": "https://appwriter.tistory.com",
            "title": "전생했더니 개발자였던 건에 관하여",
            "description": " 신나게 놀고먹고있는 23살 백수 개발자. 티스토리를 위한 티도리 프레임워크(https://tidory.co",
            "default": "1"
        }
    }
    // ...
]
```