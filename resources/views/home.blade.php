@extends('_layouts.default')


@section('content')
    <div class="content-wrapper">
        <a href="{{ URL('upload') }}">发布明信片</a>
        {!! $news !!}
    </div>
@stop

@section('jspath')
home.js
@stop