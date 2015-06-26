@extends('master')


@section('workspace')

<div class="pms-edit-table">
    <form method="POST" action="{{action("$controller@postStore")}}">
        {!! csrf_field() !!}
        @if ($action != 'getCreate' && $action != 'postCreate')
        <div class="form-group">
            <label for "id">{{trans("title.id")}}</label>
            <input name="id" type="text" readonly class="form-control" value="{{ $model->id }}"></input>
        </div>
        @endif

        {!! display_form_group($model, "dev_plan_name") !!}
        {!! display_form_group($model, "story_name", $fields_enum) !!}
        {!! display_form_group($model, "team_name", $fields_enum) !!}
        {!! display_form_group($model, "owner_name", $fields_enum) !!}
        {!! display_form_group($model, "dev_plan_type_name", $fields_enum) !!}
        {!! display_form_group($model, "priority_name", $fields_enum) !!}
        {!! display_form_group($model, "work_hour", $fields_enum) !!}
        {!! display_form_group($model, "plan_start_at", [], false, 'datetime') !!}
        {!! display_form_group($model, "plan_complete_at", [], false, 'datetime') !!}
        {!! display_form_group($model, "status_name", $fields_enum) !!}
        {!! display_form_group($model, "description", [], false, 'textarea' ) !!}
        @if ($action != 'getShow')
        <div class="col-sm-4 col-sm-offset-2">
            <button type="submit" class="btn btn-primary glyphicon glyphicon-saved">提交</button>
            <a href="{{ action("$controller@getIndex") }}" class="btn btn-default glyphicon glyphicon-remove">返回</a>
        </div>
        @endif
        {!! insert_datetime_init_script() !!}
    </form>

</div>

@endsection
