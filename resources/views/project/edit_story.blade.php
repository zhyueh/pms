@extends('master')

@section("module-helper-right")
    <a class="glyphicon glyphicon-plus" href="#">{{ trans('title.create') }}</a>
@endsection

@section('workspace')
<div class="pms-edit-table">
    <form method="POST" action="{{action("$controller@postStore")}}">
        {!! csrf_field() !!}
        @if ($action != 'getCreate')
        <div class="form-group">
            <label for "id">{{trans("title.id")}}</label>
            <input name="id" type="text" readonly class="form-control" value="{{ $model->id }}"></input>
        </div>
        @endif

        <div class="form-group">
            <label for "story_name">{{trans("title.story_name")}}</label>
            <input name="story_name" type="text" class="form-control" value="{{ $model->story_name }}"></input>
        </div>

        @foreach ($fields_edit as $f)
<?php 
$readonly = $action == 'getShow';
$value = isset($model->$f) ? $model->$f:"";
if (array_key_exists($f, $fields_enum))
{
    echo "<div class=\"form-group\">";
    echo "<label for=\"$f\">".trans("title.$f")."</label>";
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
    echo "</select></div>";
}
?>
        @endforeach

        <div class="form-group">
            <label for="description">{{ trans('title.description')}}</label>
            <script id="desc_editor" name="description" type="text/plain" class="pms-html-editor">
                {!! $model->description !!}
            </script>
        </div>

        <div class="form-group">
            <label for="requirement">{{ trans('title.requirement')}}</label>
            <script id="req_editor" name="requirement" type="text/plain" class="pms-html-editor">
                {!! $model->requirement !!}
            </script>
        </div>
        <div class="form-group">
            <label for="remark">{{ trans('title.remark')}}</label>
            <script id="remark_editor" name="remark" type="text/plain" class="pms-html-editor">
                {!! $model->remark !!}
            </script>
        </div>
        <script type="text/javascript">
            UE.getEditor('desc_editor');
            UE.getEditor('req_editor');
            UE.getEditor('remark_editor');
        </script>


        @if ($action != 'getShow')
        <div class="col-sm-4 col-sm-offset-2">
            <button type="submit" class="btn btn-primary glyphicon glyphicon-saved">提交</button>
            <a href="{{ action("$controller@getIndex") }}" class="btn btn-default glyphicon glyphicon-remove">返回</a>
        </div>
        @endif
    </form>

</div>

@endsection
