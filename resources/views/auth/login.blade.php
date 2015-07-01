@extends('base')

@section('title')
PMS 登录页

@endsection

@section('reference_before_body')

<style type="text/css">
body{
    background-color:#036;
    text-align:center;
    width:100%;
    padding-top:200px;
}

.login-form{
    background-color:#fff;
    margin:auto;
    width:400px;
    text-align:left;
    padding:20 20 20 20;
}
</style>

@endsection

@section('body')
<div class="login-form">
    <form action="/auth/login" method="POST">
        {!! csrf_field() !!}
        <div class="form-group">
            <label for="email">Email</label>
            <input class="form-control" type="email" id="email" name="email" placeholder="user@email.com">
        </div>
    
        <div class="form-group">
            <label for="password">Password</label>
            <input class="form-control" type="password" name="password" id="password">
        </div>
    
        <div class="checkbox">
            <label>
            <input type="checkbox" name="remember"> Remember Me
            </label>
        </div>
    
        <div>
            <button class="btn btn-default" type="submit">Login</button>
            <a class="btn btn-default" href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/auth/register" role="button">Register</a>
        </div>
    </form>
    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
    @endif
</div>
@endsection
