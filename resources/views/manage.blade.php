@extends('layouts.app')

@section('title', '- 내 블로그 관리')

@section('main')
    @include('parts.thumbnail', [
        'component'   => 'Thumbnail',
        'thumbnails'  => $manage,
        'added_parameters' => [
            'is_manage'   => true
        ]
    ])
@endsection