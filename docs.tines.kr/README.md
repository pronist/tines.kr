# 티네스 API 소개

**티네스 API** 를 사용하여 티스토리 API와 연계하여 티네스에서 제공하는 정보를 취득할 수 있습니다. 제공하는 API로는 **로그인 및 로그아웃**, **사용자 조회**, 티네스에 등록된 **블로그**, **구독자**, **이웃 조회 및 추가, 삭제**, **3일 이내의 글** 기능을 제공합니다.

### 티네스 API

|이름|설명|요청 URL|HTTP Method|
|----|---|--------|-----------|
|로그인|티네스에 로그인합니다.|https://api.tines.kr/v1/auth/login|POST|
|로그이웃|티네스에서 로그아웃합니다.|https://api.tines.kr/v1/auth/logout|GET|
|블로그 조회|티네스에 등록된 블로그를 조회합니다.|https://api.tines.kr/v1/blogs|GET|
|구독자|특정 유저의 구독자를 조회합니다.|https://api.tines.kr/v1/subscribers|GET|
|이웃|특정 유저의 이웃을 조회합니다.|https://api.tines.kr/v1/neighbors|GET|
|이웃 추가|특정 블로그를 내 이웃으로 추가합니다.|https://api.tines.kr/v1/neighbors|POST|
|이웃 삭제|내 이웃에서 특정 블로그를 삭제합니다.|https://api.tines.kr/v1/neighbors/{name}|DELETE|
|3일 이내의 글|특정 유저의 이웃이 작성한 3일 이내의 글을 조회합니다.|https://api.tines.kr/v1/posts|GET|
