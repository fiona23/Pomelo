@extends('_layouts.default')

@section('content')
    <div class="content-wrapper">
        <p>{{ $nickname }}</p>
        <div id="mytoken" value="{{ csrf_token() }}"></div>
        @if ( $auth !== $title)
        <button id="{{ $title }}" class="{{ $class }} sf-follow-btn">{{ $btnHTML }}</button>
        @endif

        @foreach ($postcards as $postcard)
            <div class="want-exchange-postcards">
                <img src="{{ url($postcard->cutpath) }}" alt="">
            </div>
        @endforeach
    </div>
    
@stop

@section('jspath')
people.js
@stop