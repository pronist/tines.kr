<?php

namespace App\Classes\Api\v1;

use Carbon\Carbon;

use Tistory\Exceptions\BadResponseException;

use Illuminate\Support\Facades\Config;

use App\Classes\Api\v1\Thumbnail;

class Post
{
    private static function getPostsInThreeDays($blogs)
    {
        try {
            $access_token = auth()->payload()->get('access_token');

            $postsInThreeDays = [];

            /** 시간대를 설정합니다. */
            Carbon::setLocale('ko');
            $date = new Carbon(Carbon::now(), 'Asia/seoul');

            foreach($blogs as $blog) {
                /** 포스트 작성자의 블로그 'name' 필드를 키로 사용합니다. */

                $postsInThreeDays[$blog->name] = [];

                try {
                    $articles = \Pronist\Tistory\Post::list(
                        $access_token,
                        [
                            'blogName' => $blog->name,
                            'count'    => '10'
                        ]
                    );
                    /** 포스트가 있습니까? */
                    if(isset($articles->posts)) {
                        /** 해당 블로거의 포스트를 구합니다. */
                        foreach($articles->posts as $post) {
                            /**
                             * 공개 글만 불러옵니다.
                             * https://tistory.github.io/document-tistory-apis/apis/v1/post/list.html
                             */
                            if($post['visibility'] == "3") {
                                /** 작성된 지 3일 이내의 포스트만 배열에 넣습니다. */
                                if($date->diffInDays($post['date']) < 4) {
                                    array_push($postsInThreeDays[$blog->name], (object) $post);
                                }
                            }
                        }
                    }
                }
                catch(BadResponseException $e) {
                    continue;
                }
            }
            return $postsInThreeDays;
        }
        catch(\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public static function get($blogs, $start, $count)
    {
        try {
            $postsInThreeDays2 = [];

            foreach(Post::getPostsInThreeDays($blogs) as $blogName => $posts) {

                /** 블로그의 이름은 절대 중복되지 않습니다. **/
                $blogger = \App\Blog::where('name', '=', $blogName)->first();

                foreach($posts as $post) {
                    array_push($postsInThreeDays2, [
                        'id'      => $post->id,
                        'title'   => iconv_substr($post->title, 0, 60, 'utf-8'),
                        'url'     => $post->postUrl,
                        'date'    => $post->date,
                        'blogger' => Thumbnail::view($blogger)
                    ]);
                }
            }
            return array_slice($postsInThreeDays2, $start, $count);
        }
        catch(\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
