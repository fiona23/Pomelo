<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>柚子肉</title>

  <link href="/css/style.less" rel="stylesheet/less" type="text/css">
  <script type="text/javascript" src="/js/less.min.js"></script>
</head>
<body>
<header>
    <div class="header-wrapper">
        <div class="index-link">
            <a href="{{ '/' }}" id="logo">柚子</a>
            <a href="{{ url('/') }}">柚子</a>
        </div>
        <nav class="top-nav">
        <a href="{{ URL('auth/register') }}">注册</a>
        <a href="{{ URL('auth/login') }}">登陆</a>
        </nav>
    </div>
</header>

  @yield('content')

<footer></footer>
</body>
</html>