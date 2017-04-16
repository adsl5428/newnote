<a href="{{ URL('/') }}">首页</a>
@if( Session::get('name')==null)
    <a href="{{ URL('/login') }}">登录</a>
    <a href="{{ URL('/register') }}">注册</a>
@else
    <a href="{{ URL('/myinfo') }}">{{ Session::get('name')}}</a>
    <a href="{{ URL('/logout') }}">退出</a>
@endif

<hr>
