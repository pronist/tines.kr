@extends('layouts.app')

@section('title', '- 구독자')

@section('main')
    @include('parts.thumbnail', [
        'component'        => 'Thumbnail',
        'thumbnails'       => $subscribers,
        'request_url'      => '/subscribers',
        'added_parameters' => [
            'is_add' => true
        ]
    ])
@endsection