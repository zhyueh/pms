<html>
<body>
<form action="/auth/login" method="POST">
{!! csrf_field() !!}
<div>
        email
        <input type="email" name="email" value="admin@admin.com">
    </div>

    <div>
        Password
        <input type="text" value="123456"  name="password" id="password">
    </div>

    <div>
        <input type="checkbox" name="remember"> Remember Me
    </div>

    <div>
        <button type="submit">Login</button>
    </div>
</form>
</body>
</html>
