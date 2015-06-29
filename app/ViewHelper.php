<?php

function display_nav_menu($nav_menu, $nav_active_menu='')
{
    $html = "";
    foreach($nav_menu as $menu)
    {
        $html = $html."<li role='presentation' ";

        if ($menu->name == $nav_active_menu){
            $html = $html."class='active'";
        }
        $html = $html."><a href='".action($menu->action)."'>$menu->name</a></li>";
    }
    return $html;
}

function display_nav_sub_menu($nav_sub_menu)
{
    $html = "";
    foreach($nav_sub_menu as $menu)
    {
        $html = $html."<div class='pms-sub-nav-item'>";
        $html = $html."<a href='".action($menu->action)."'>$menu->name</a>";
        $html = $html."</div>";
    }
    return $html;

}

function display_value($model, $f, $fields_enum)
{
    if (array_key_exists($f, $fields_enum))
    {
        $field_spec = $fields_enum[$f];
        $field_id = $field_spec["field"];

        if (array_key_exists($model->$field_id, $field_spec["enum"]))
        {
            return $field_spec["enum"][$model->$field_id];
        }else{
            return "-";
        }
    }else{
        return $model->$f;
    }
}

function form_group_field_id($f, $fields_enum){
    if (array_key_exists($f, $fields_enum))
    {
        $field_spec = $fields_enum[$f];
        return $field_spec["field"];
    }
    else
    {
        return $f;
    }
}

function form_group_display_value($model, $f, $fields_enum)
{
    if (array_key_exists($f, $fields_enum))
    {
        $field_spec = $fields_enum[$f];
        $field_id = $field_spec['field'];
        return array_get($field_spec["enum"], $model->$field_id, "-");
    }
    else
    {
        return $model->$f;
    }
}



function display_form_group($model, $f, $fields_enum=[], $readonly=false, $control_type='')
{
    $field_id = form_group_field_id($f, $fields_enum);
    $html = "<div class='form-group'>";
    $html = $html."<label for='$field_id' >".trans("title.$f")."</label>";

    if ($control_type == '')
    {
        $html = $html.display_edit_control($model, $f, $fields_enum, $readonly);
    }
    else
    {
        $display_func = "display_${control_type}_control";
        $html = $html.$display_func($model, $f, $fields_enum, $readonly);
    }
    $html = $html."</div>";

    return $html;
}

function display_datetime_control($model, $f, $fields_enum, $readonly)
{
    $html = "<div id='dtp_$f' class=\"input-append date form_datetime\">";
    $html.= "<input class='form-control' name='$f' type='text' value='".$model->$f."' readonly>";
    $html.= "<span class=\"add-on\"><i class=\"icon-th\"></i></span>";
    $html.= "</div>";

    return $html;

}

function display_textarea_control($model, $f, $fields_enum, $readonly)
{
    $value = $model->$f;
    $html = "<textarea name=\"$f\" class=\"form-control\" >$value";
    if ($readonly)
    {
        $html = $html." readonly ";
    }

    $html = $html."</textarea>";
    return $html;

}

function display_edit_control($model, $f, $fields_enum=[], $readonly=false)
{
    if (array_key_exists($f, $fields_enum))
    {
        return display_dropdownlist_control($model, $f, $fields_enum, $readonly);
    }
    else
    {
        return display_input_control($model, $f, $readonly);
    }
}

function display_dropdownlist_control($model, $f, $fields_enum, $readonly=false)
{
    $field_spec = $fields_enum[$f];

    $field_id = $field_spec["field"];
    $value = $model->$field_id;
    $field_dict = $field_spec["enum"];

    $readonly_str = $readonly ? " readonly " : "";
    $html = "<select name='$field_id' class='form-control' $readonly_str>";

    reset($field_dict);
    while (list($k, $v) = each($field_dict))
    {
        if ($readonly && $k != $value)
        {
            continue;
        }

        $html = $html."<option value='$k'";
        if ($k == $value){
            $html = $html." selected='selected' ";
        }
        $html = $html." >$v</option>";
    }
    $html = $html."</select>";
    return $html;

}

function display_input_control($model, $f, $readonly=false)
{
    $value = $model->$f;
    $html = "<input id=\"$f\" name=\"$f\" class=\"form-control\" value=\"$value\" ";
    if ($readonly)
    {
        $html = $html." readonly ";
    }

    if ($f == "password") 
    {
        $html = $html." type='password' ";
    }
    else
    {
        $html = $html." type='text' ";
    }

    $html = $html."></input>";
    return $html;
}

function display_html_control($model, $f, $fields_enum, $readonly)
{
    $html = "";
    if ($readonly ==false)
    {
            $html = $html."<script id='${f}_ueditor' name='$f' type='text/plain' class='pms-html-editor'>";
            $html = $html.$model->$f;
            $html = $html."</script>";
            $html = $html."<script type='text/javascript'>";
            $html = $html."UE.getEditor('${f}_ueditor');";
            $html = $html."</script>";
    }
    return $html;

}

function display_custom_group_value($k, $v)
{
    $html = "<div class='pms-display-group'>";
    $html .= "<div class='pms-group-title'><span>".trans("title.$k").":</span></div>";
    $html .= "<div class='pms-group-value'><span>".$v."</span></div>";
    $html .= "<div class='clear'></div>";

    $html .= "</div>";

    return $html;
}

function display_group_value($model, $f, $fields_enum, $type = '')
{
    $html = "<div class='pms-display-group'>";

    if ($type == '')
    {
        $html = $html.display_input_group_value($model, $f, $fields_enum);
    }
    else
    {
        $display_func = "display_${type}_group_value";
        $html = $html.$display_func($model, $f, $fields_enum);
    }
    $html = $html."</div>";

    return $html;
}

function display_input_group_value($model, $f, $fields_enum)
{
    $html = "<div class='pms-group-title'><span>".trans("title.$f").":</span></div>";
    $html = $html."<div class='pms-group-value'><span>".form_group_display_value($model, $f, $fields_enum)."</span></div>";
    $html = $html."<div class='clear'></div>";

    return $html;
}

function insert_datetime_init_script()
{
    $script = '<script type="text/javascript">'
        .'$(".form_datetime").datetimepicker({'
        .'format:"yyyy-mm-dd hh:00:00",'
        .'todayHighlight: 1,'
        .'daysOfWeekDisabled:[0,6],'
        .'hoursDisabled:[0,1,2,3,4,5,6,7,8,12,13,18,19,20,21,22,23],'
        .'autoclose:1,'
        .'todayBtn:1,'
        .'weekStart:1,'
        .'minView:1,'
        .'startView:2,'
        .'forceParse:1,'
        .'});'
        .'</script> ';
    return $script;

}

function insert_destroy_script()
{
    $script = '<script type="text/javascript">'
        .'function destroy(id){'
        .'if(confirm("'.trans('title.confirm_delete'). '=> " + id)){'
        .'window.location = "'.action_url(gen_action("getDestroy")).'?id="+ id;'
        .'}'
        .'}'
        .'</script>';

    return $script;
}

function create_button($operation, $privileges, $parms, $short=false)
{
    /* spec for admin manager button list :) */
    list($controller, $action) = explode("@", $operation->route);

    if (Auth::User()->id == 1)
    {
        App\Http\Models\Setting\Route::addRoute($operation->route);
    }

    if ($operation->name == "destroy")
    {
        return create_destroy_button($operation, $privileges, $parms);

    }

    $action_url = action_url($operation->route, $parms);
    
    $btn_name = "";//empty($operation->name)? "" : trans("title.".$operation->name);
    $btn_type = $operation->style_type;
    $btn_icon = $operation->style_icon;

    $html = "<a class='btn btn-$btn_type glyphicon glyphicon-$btn_icon' href='$action_url'>";
    if(!$short)
    {
        $html.=$btn_name;
    }
    
    $html.="</a>";
    return $html;
}  

function create_destroy_button($operation, $privileges=[], $parms=[], $short=true)
{
    $btn_name = ($short || empty($operation->name)) ?  "" : trans("title.".$operation->name);
    $id = $parms['id'];

    return '<a class="btn btn-danger glyphicon glyphicon-trash" onclick="destroy('.$id.");\">$btn_name</a>";
}
