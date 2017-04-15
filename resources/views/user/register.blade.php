<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>注册</title>
</head>
<h1>欢迎加入</h1>
<hr>
@if(count($errors)>0)
    @foreach($errors->all() as $error)
        {{$error}}
    @endforeach
@endif
<form action="{{ URL('/store') }}" method="post" >
    {{csrf_field()}}
    <lable>账号</lable>
    <input type="text" name="name"  value="456789"><br>
    <lable>email</lable>
    <input type="text" name="email"  value="121545@qq.com"><br>
    <lable>密码</lable>
    <input type="password" name="password"  value="123456"><br>
    <lable>重复密码</lable>
    <input type="password" name="password_confirmation"  value="123456"><br>
    <input type="submit"  value="注册">
</form>
<body>


</body>
</html>