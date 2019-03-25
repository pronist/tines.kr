@extends('layouts.app')

@section('title', '- 내 이웃')

@section('main')
    @include('parts.thumbnail', [
        'component'   => 'Thumbnail',
        'thumbnails'  => $neighbors,
        'request_url' => '/neighbors'
    ])
@endsection