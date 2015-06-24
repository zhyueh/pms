@extends('base')


@section('reference_after_body')
<script type="text/javascript">
    function showAlert(id, type){
        trimValue = $("#" + id).html().trim()
        if (trimValue != ''){
            $("#" + id).show(); 
            $("#" + id).addClass("alert").addClass("alert-" + type);
            console.log(trimValue);
        }
    }
    showAlert("pms-notification", "info");
    showAlert("pms-warning", "danger");
    $(".pms-table>tbody>tr:odd").css("background-color", "#f9f9f9"); 
    $(".pms-table>tbody>tr:even").css("background-color", "#fff"); 
</script>

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
<?php 
foreach($nav_menu as $menu)
{
    echo "<li role='presentation' ";

    if ($menu->name == $nav_active_menu){
        echo "class='active'";
    }
    echo "><a href='".action($menu->action)."'>$menu->name</a></li>";
}

?>
    </div>
    <div class="pms-sub-module-nav">
       @section('sub-header')
<?php
foreach($nav_sub_menu as $menu)
{
    echo "<div class='pms-sub-nav-item'>";
    echo "<a href='".action($menu->action)."'>$menu->name</a>";
    echo "</div>";
}
?>
    <div class="clear"></div>
       @show()
    </div>
</div>
<div class="pms-body">
    <div class="pms-body-content">
        <div id="pms-notification" class="pms-notification" role="alert">
            @yield('notification')
        </div>
        <div id="pms-warning" class="pms-warning" role="alert">
            @yield('warning')
        </div>
        <div class="pms-module-helper">
            <div class="pms-module-helper-left">
                @section('module-helper-lect')
                @show()
            </div>
            <div class="pms-module-helper-right">
                @section('module-helper-right')
                @show()
            </div>
            <div class="clear"></div>
        </div>
        <div class="pms-workspace">
            @section('workspace')
            workspace
            @show()
        </div>
    </div>
</div>
<div class="pms-power">
    <span> powered by 10s!</span> 
</div>
@endsection
