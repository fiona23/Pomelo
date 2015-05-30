<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="_token" content="{!! csrf_token() !!}"/>
  <title>{{ $title }}</title>
  <link href="/css/style.css" rel="stylesheet">
</head>
<body>
<header>
<a href="{{ url('/') }}">柚子</a>
<nav>
    <a href="{{ url('/auth/logout') }}">Logout</a>
    <a href="{{ url('/people/'.$auth) }}">{{ $auth }}</a>
</nav>
</header>

@yield('content')

<footer></footer>
<script type="text/javascript" src="/js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="/js/@yield('jspath')"></script>
</body>
</html>