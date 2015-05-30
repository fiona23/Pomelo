@extends('_layouts.default')

@section('content')
    <p>{{ $nickname }}</p>
    <div id="mytoken" value="{{ csrf_token() }}"></div>
    @if ( $auth !== $title)
    <button id="{{ $title }}" class="{{ $class }} sf-follow-btn">{{ $btnHTML }}</button>
    @endif

    @foreach ($postcards as $postcard)
        <div>
            <img src="{{ url($postcard->path) }}" alt="">
        </div>
    @endforeach
@stop

@section('jspath')
people.js
@stop