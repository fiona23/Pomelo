@extends('_layouts.default')

@section('content')
@if(Session::has('success'))
  <div class="alert-box success">
    <p>{!! Session::get('success') !!}</p>
    <img src="{!! Session::get('path') !!}" alt="柚子肉 交换明信片" class="upload-postcard">
  </div>
@endif
  <form action="{{ URL('upload/add') }}" method="post" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="file" name="postcard">
    <input type="submit">
  </form>
@endsection