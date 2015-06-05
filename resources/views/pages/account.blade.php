@extends('_layouts.default')

@section('content')
<p>{!! Session::get('success') !!}</p>
<p>我的账号{{ $auth }} (不好意思, 暂时不可更改)</p>
<a href="/password/email">修改密码</a>
<form action="/account" method="post">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="input-block">
        <label for="">我的昵称</label>
        <input class="input-box" type="text" name="nickname" value='{{ $nickname }}'>
    </div>
    <div class="input-block">
        <label for="">我的邮箱</label>
        <input class="input-box" type="text" name="email" value='{{ $email }}'>
    </div>
    <div class="input-block">
        <p>请输入你的详细地址，地址只会提供给与你交换明信片的小伙伴，不会公开。记得写邮编哦</p>
        <textarea name="address" id="" cols="64" rows="10">{{ $address }}</textarea>
    </div>
    <button class="submit-btn" type="submit">确认修改</button>
</form>

@stop