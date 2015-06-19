@extends('base')

@section('reference_before_body')

<style type="text/css">
.pms-header{
    background-color:#036;
    margin:auto;
    width:100%;
}

.pms-body{
    background-color:#e0e0e0;
    padding:20 20 20 20;
}

.pms-power{
    width:100%;
    background-color:#e0e0e0;
    padding:10px;
    text-align:center;
    color:#000;
}

.pms-workspace{
    border:1px solid #cfcfcf;
    background-color:#fff;
    padding:20 20 20 20;
}
.pms-header-top{
    padding-right:10px;
    padding-top:10px;
}
.website-name{
    width:auto;
    padding-left:30px;
    color:#fc0;
    text-align:left;
    float:left;
}
.person{
    width:auto;
    color:#fff;
    float:right;
    padding-right:80px;
}

.pms-module-nav{
    padding-left:20px;
    margin-top:5px;
}

.pms-sub-module-nav{
    padding-top:10px;
    padding-left:20px;
    background-color:#e0e0e0;
}

.pms-user{
    color:#d1e4f2;
    padding:5px 5px;
}

.pms-user:hover{
    background-color:#2e6dad;
    color:#fff;
    cursor:pointer;
}
.clear{
    clear:both;
}
</style>


@endsection

@section('body')
<div class="pms-header">
    <div class="pms-header-top">
        <div class="website-name">pms</div>
        <div class="person">
            <div class="dropdown">
                <a class="dropdown-toggle pms-user" type="button" id="dropdownMenu1" data-toggle="dropdown">
                    <div class="glyphicon glyphicon-user">
                    <span class="user_name">{{ $login_user->name}}<span>
</div>
                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">个人信息</a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">修改密码</a></li>
                    <li class="divider"></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo action('Auth\AuthController@getLogout'); ?>">退出</a></li>
                </ul>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    <div class="clear"></div>
    <div class="pms-module-nav">
        <ul class="nav nav-tabs">
            <li role="presentation" class="active"><a href="#">主页</a></li>
            <li role="presentation"><a href="#">项目</a></li>
            <li role="presentation"><a href="#">时间表</a></li>
            <li role="presentation"><a href="#">会议</a></li>
            <li role="presentation"><a href="#">周报</a></li>
        </ul>
    </div>
    <div class="pms-sub-module-nav">
       @section('sub-header')
       sub-header
       @show()
    </div>
</div>
<div class="pms-body">
    <div class="pms-workspace">
        @section('workspace')
        workspace
        @show()
    </div>
</div>
<div class="pms-power">
    <span> powered by 10s!</span> 
</div>
@endsection
