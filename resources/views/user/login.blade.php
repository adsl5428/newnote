
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>登录</title>
</head>

<body>

@include('app')
{{$hi}}
<form action="{{ URL('/login1') }}" method="post" >
    {{csrf_field()}}
    <lable>账号</lable>
    <input type="text" name="name"  value="456789"><br>
    <lable>密码</lable>
    <input type="password" name="password"  value="123456"><br>
    <input type="submit"  value="登录">
</form>
</body>
</html>