@extends('layouts.app')

@section('main')
    @include('parts.thumbnail', [
        'component'        => 'Thumbnail',
        'thumbnails'       => $blogs,
        'added_parameters' => [
            'is_add'   => true,
            'is_index' => true
        ]
    ])
@endsection