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

<div class="content-wrapper">
	<form role="form" method="POST" action="{{ url('/auth/register') }}">
		<h2 class="page-title">注册</h2>
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<div class="input-block">
			<label >用户名</label>
			<input class="input-box" type="text" name="name" value="{{ old('name') }}">
		</div>
		<div class="input-block">
			<label>邮箱</label>
			<input class="input-box" type="email" name="email" value="{{ old('email') }}">
		</div>
		<div class="input-block">
			<label>密码</label>
			<input class="input-box" type="password" name="password">
		</div>
		<div class="input-block">
			<label>再次输入</label>
			<input class="input-box" type="password" name="password_confirmation">
		</div>
		<button class="submit-btn" type="submit">注册</button>
	</form>
</div>
@endsection
