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

<form action="{{ URL('admin/pages')  }}" method="post">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="text" name="title" required="required">
    <br />
    <textarea name="body" id="" rows="10" required="required"></textarea>
    <br />
    <input type="submit">
</form>
@endsection