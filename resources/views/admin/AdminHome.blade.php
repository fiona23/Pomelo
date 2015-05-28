@extends('_layouts.default')

@section('content')
<a href="{{ URL('') }}">新增</a>
    @foreach( $pages as $page)
        <h4>{{ $page->title }}</h4>
        <p>{{ $page->body }}</p>
        <a href="{{ URL('admin/pages/create')}} ">编辑</a>
        <form action="{{ URL('admin/pages/'.$page->id) }}" method="post">
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="_token" value="csrf_token()">
            <input type="submit" value="删除"> 
        </form>
    @endforeach
    
@endsection