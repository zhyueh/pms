<?php

function base_url($suffix)
{
    return "http://".$_SERVER['SERVER_NAME']."/$suffix";
}

function action_url($action, $params=[])
{
    if(!strstr($action, '@'))
    {
        $action = gen_action($action);
    }
    $url = action($action);
    if (count($params) > 0)
    {
        $url = $url."?".http_build_query($params);
    }
    return $url;
}

function add_enum_dict($fields_enum, $name, $id, $dict)
{
    $fields_enum[$name] = [
        'field'=>$id,
        'enum'=>$dict,
        ];
}

function get_current_route()
{
    $route = Route::currentRouteAction();
    return str_replace('App\\Http\\Controllers\\', '', $route);
}

function get_current_controller()
{
    return explode('@', get_current_route())[0];
}

function get_current_action()
{
    return explode('@', get_current_route())[1];
}

function gen_action($action)
{
    return get_current_controller()."@".$action;
}

function input_contain_empty($k)
{
    return Input::get($k, "1") == "";
}


/** date operation **/
function date_after($date, $days=1)
{
    return date("Y-m-d H:M:S", strtotime($date) + 60 * 60 * 24* $days);

}
