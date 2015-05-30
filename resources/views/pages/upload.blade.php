@extends('_layouts.default')

@section('content')
@if(Session::has('success'))
  <div class="alert-box success">
    <p>{!! Session::get('success') !!}</p>
    <a href="{{ url('/') }}">回到首页</a>
    <a href="{{ url('upload') }}">继续上传</a>
  </div>
@else
  <form id="upload-form" action="{{ URL('upload') }}" method="post" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="file" name="postcard[]" accept="image/jpg,image/jpeg,image/bmp,image/gif,image/png," multiple>
    <span id="count"></span>
    <ul id="uploaded-postcards"></ul>
    <input type="submit" value="保存">
    <a href="{{ url('upload') }}">取消</a>
  </form>
@endif
@stop

@section('jspath')
upload.js
@stop