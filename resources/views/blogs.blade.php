@extends('layouts.app')

@section('components')
    <app-showcase></app-showcase>
@endsection

@section('main')
    @include('parts.thumbnail', [
        'component'        => 'Thumbnail',
        'thumbnails'       => $blogs,
        'request_url'      => '/blogs',
        'added_parameters' => [
            'is_add'   => true,
            'is_index' => true
        ]
    ])
@endsection