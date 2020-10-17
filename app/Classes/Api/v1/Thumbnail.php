<?php

namespace App\Classes\Api\v1;

class Thumbnail
{
    private static function isOwn($blog)
    {
        /** 로그인이 되어 있어야 합니다. */
        if(auth()->check()) {
            /** 현재 블로그가 로그인한 유저의 블로그입니까? */
            return $blog->user()->first() == auth()->user()? true : false;
        }
    }

    private static function isAlready($blog)
    {
        /** 로그인이 되어 있어야 합니다. */
        if(auth()->check()) {
            /** 이미 이웃일까요? */
            return auth()->user()->neighbors()->where('blog_id', '=', $blog->id)->first()? true: false;
        }
    }

    public static function build($blog, $object, $method)
    {
        $object->$method([
            'name'                      => $blog->name,
            'url'                       => $blog->url,
            'secondaryUrl'              => $blog->secondaryUrl,
            'nickname'                  => $blog->nickname,
            'title'                     => $blog->title,
            'description'               => $blog->description,
            'default'                   => $blog->default == 'Y'? true: false,
            'blogIconUrl'               => $blog->blogIconUrl,
            'faviconUrl'                => $blog->faviconUrl,
            'profileThumbnailImageUrl'  => $blog->profileThumbnailImageUrl,
            'profileImageUrl'           => $blog->profileImageUrl,
            'role'                      => $blog->role,
            'blogId'                    => $blog->blogId,
            'statistics'                => json_encode($blog->statistics)
        ]);
    }

    public static function getUnregistered($registered, $access_token)
    {
        if(auth()->check()) {
            $user = \Pronist\Tistory\Blog::info($access_token);
            $unregistered = [];

            /** 블로그 중 등록되지 않은 블로그만 추가합니다. */
            foreach($user->blogs as $b) {
                $isContain = false;
                foreach($registered as $blog) {
                    if($b['name'] === $blog->name) {
                        $isContain = true;
                    }
                }
                if(!$isContain) {
                    array_push($unregistered, array_merge($b, [
                        'is_own' => true,
                        'is_already' => false
                    ]));
                }
            }
            return $unregistered;
        }
    }

    public static function view($blog)
    {
        return [
            'id'              => $blog->id,
            'profileImageUrl' => $blog->profileImageUrl,
            'nickname'        => $blog->nickname,
            'name'            => $blog->name,
            'url'             => $blog->url,
            'title'           => $blog->title,
            'description'     => $blog->description,
            'default'         => $blog->default
        ];
    }

    public static function get($blogs)
    {
        $thumbnails = [];

        foreach($blogs as $blog) {
            $thumbnail = Thumbnail::view($blog);
            if(auth()->check()) {
                $thumbnail = array_merge($thumbnail, [
                    'is_own'     => Thumbnail::isOwn($blog),
                    'is_already' => Thumbnail::isAlready($blog)
                ]);
            }
            array_push($thumbnails, $thumbnail);
        }
        return $thumbnails;
    }
}
