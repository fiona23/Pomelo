@extends('_layouts.stranger')

@section('content')

@if (count($errors) > 0)
		<strong>Whoops!</strong> There were some problems with your input.<br><br>
		<ul>
			@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
@endif
<div class="content-wrapper">
	<h2 class="page-title">登陆柚子</h2>
	<form role="form" method="POST" action="{{ url('/auth/login') }}">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<div class="input-block">
			<label>邮箱</label>
			<input class="input-box" type="email" name="email" value="{{ old('email') }}">
		</div>
		<div class="input-block">
			<label>密码</label>
			<input class="input-box" type="password" name="password">
		</div>
		<label class="remember-login">
			<input type="checkbox" name="remember"> 下次自动登陆|
			<a href="{{ url('/password/email') }}">忘记密码?</a>
		</label>
		<button class="submit-btn" type="submit">登陆</button>
	</form>
</div>
@endsection
