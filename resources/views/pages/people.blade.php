@extends('_layouts.default')

@section('content')
    <p>{{ $nickname }}</p>
    <div id="mytoken" value="{{ csrf_token() }}"></div>
    <button id="{{ $title }}" class="{{ $class }} sf-follow-btn">{{ $btnHTML }}</button>
@stop

@section('jspath')
people.js
@stop