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

        {!! display_form_group($model, "story_name", $fields_enum ) !!} 
        {!! display_form_group($model, "project_name", $fields_enum, $action == 'getEdit') !!} 
        {!! display_form_group($model, "module_name", $fields_enum, $action == 'getEdit') !!} 
        {!! display_form_group($model, "version_name", $fields_enum) !!} 
        {!! display_form_group($model, "status_name", $fields_enum) !!} 
        {!! display_form_group($model, "priority_name", $fields_enum) !!} 

        {!! display_form_group($model, "description", $fields_enum, false, 'html') !!}
        {!! display_form_group($model, "requirement", $fields_enum, false, 'html') !!}
        {!! display_form_group($model, "remark", $fields_enum, false, 'html') !!}

        <script type="text/javascript">
            UE.getEditor('description_ueditor');
            UE.getEditor('requirement_ueditor');
            UE.getEditor('remark_ueditor');
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
