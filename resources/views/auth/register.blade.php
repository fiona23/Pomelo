@extends('_layouts.stranger')

@section('content')

@if (count($errors) > 0)
	<div class="alert alert-danger">
	<strong>Whoops!</strong> There were some problems with your input.<br><br>
	<ul>
	@foreach ($errors->all() as $error)
		<li>{{ $error }}</li>
	@endforeach
	</ul>
	</div>
@endif

<form role="form" method="POST" action="{{ url('/auth/register') }}">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<label >Name</label>
	<input type="text" name="name" value="{{ old('name') }}">
	<label>E-Mail Address</label>
	<input type="email" name="email" value="{{ old('email') }}">
	<label>Password</label>
	<input type="password" name="password">
	<label>Confirm Password</label>
	<input type="password" name="password_confirmation">
<button type="submit">
	Register
</button>
</form>
@endsection
