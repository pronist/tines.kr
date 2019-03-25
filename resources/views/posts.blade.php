@extends('layouts.app')

@section('title', '- 새 글 보기')

@section('main')
    @include('parts.thumbnail', [
        'component'   => 'Post',
        'thumbnails'  => $posts,
        'request_url' => '/posts',
    ])
@endsection