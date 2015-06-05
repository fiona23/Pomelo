<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="_token" content="{!! csrf_token() !!}"/>
  <title>{{ $title }}</title>
  <!-- <link href="/css/style.css" rel="stylesheet type="text/css""> -->
  <link href="/css/style.less" rel="stylesheet/less" type="text/css">
  <script type="text/javascript" src="/js/less.min.js"></script>
</head>
<body>
<header>
    <div class="header-wrapper">
        <div class="index-link">
            <a href="{{ '/' }}" id="logo">柚子</a>
            <a href="{{ url('/') }}">柚子</a>
            <a href="">发现</a>
            <a>消息()</a>
        </div>

        <nav class="top-nav">
            <a class="auth-link" href="{{ url('/people/'.$auth) }}" data-auth="{{ $auth }}">{{ $auth }}</a>
            <span class="arrow"></span>
            <ul class="top-nav-dropdown">
                <li><a href="{{ url('/people/'.$auth) }}">{{ $auth }}的主页</a></li>
                <li><a href="{{ url('/account') }}">{{ $auth }}的账号</a></li>
                <li><a href="{{ url('/auth/logout') }}">退出</a></li>
            </ul>
        </nav>
    </div>
</header>
<div class="content-wrapper">
@yield('content')

<div>
<footer class="fleft content-wrapper">
  © 2015 pomelon.com, all rights reserved
</footer>

<script type="text/javascript" src="/js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="/js/@yield('jspath')"></script>
</body>
</html>