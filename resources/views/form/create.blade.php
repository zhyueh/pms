@extends('master')

@section("module-helper-right")
    <a class="glyphicon glyphicon-plus" href="#">{{ trans('title.create') }}</a>
@endsection

@section("notification")
{{ $controller }}
@endsection

@section('workspace')
<div class="pms-edit-table">
    <form method="POST" action="{{action("$controller@postStore")}}">
        {!! csrf_field() !!}
        @if ($action != 'getCreate')
        <div class="form-group">
            <label for "id">{{trans("title.id")}}</label>
            <input name="id" type="text" readonly class="form-control" value="{{ $model->id }}"></input>
        </did>
        @endif

        @foreach ($fields_edit as $f)
        <div class="form-group">
            <label for="{{$f}}">{{ trans("title.$f") }}</label>
<?php 
$readonly = $action == 'getShow';
$value = isset($model->$f) ? $model->$f:"";
if (array_key_exists($f, $fields_enum))
{
    $field_spec = $fields_enum[$f];

    $field_id = $field_spec["field"];
    $value = $model->$field_id;
    $field_dict = $field_spec["enum"];

    echo "<select name='$field_id' class='form-control'>";
    reset($field_dict);
    while (list($k, $v) = each($field_dict))
    {
        
        echo "<option value='$k'";
        if ($k == $value){
            echo " selected='selected' ";
        }
        echo " >$v</option>";
    }
    echo "</select>";
}
else
{
    echo "<input name=\"$f\" type=\"text\" class=\"form-control\" value=\"$value\" ";
    if ($readonly)
    {
        echo " readonly ";
    }
    echo "></input>";
} ?>
        </div>
        @endforeach
        @if ($action != 'getShow')
        <div class="col-sm-4 col-sm-offset-2">
            <button type="submit" class="btn btn-primary glyphicon glyphicon-saved">提交</button>
            <a href="{{ action("$controller@getIndex") }}" class="btn btn-default glyphicon glyphicon-remove">返回</a>
        </div>
        @endif
    </form>

</div>

@endsection
