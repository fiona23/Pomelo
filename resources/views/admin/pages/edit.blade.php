@extends('_layouts.default')

@section('content')

@if (count($errors) > 0)
    <div>
        <p>whoops! there is some problem in you input</p>
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

<form action="{{ URL('admin/pages'.$page->id) }}" method="post">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="text" name="title" required="required" value="{{ $page->title }}">
    <textarea name="body" id="" cols="30" rows="10" required="required" value="{{ $page-body }}"></textarea>
    <input type="submit">
</form>
@endsection