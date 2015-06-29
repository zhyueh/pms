@extends("master")

@section('reference_before_body')
<link rel="stylesheet" href="{{ base_url("asset/css/proj/view_bug.css") }}">
@endsection

@section("workspace")

<div class="panel panel-info bug-desc-panel">
    <div class="panel-heading">bug{{trans('title.description')}}</div>
    <div class="panel-body">
        {!! display_group_value($model, "test_case_name", $fields_enum) !!}
        {!! display_group_value($model, "bug_name", []) !!}
        {!! display_group_value($model, "team_name", $fields_enum) !!}
        {!! display_group_value($model, "owner", $fields_enum) !!}
        {!! display_group_value($model, "description", [], false, 'html') !!}
        {!! display_group_value($model, "requirement", [], false, 'html') !!}
        {!! display_group_value($model, "status", $fields_enum) !!}
        {!! display_group_value($model, "serverity", $fields_enum) !!}
        {!! display_group_value($model, "priority", $fields_enum) !!}
    </div>
</div>

<div class="panel panel-primary bug-commit-panel">
    <div class="panel-heading">bug{{trans('title.operation')}}</div>
    <div class="panel-body">
        @foreach ($operations as $operation)
            {!! create_button($operation, $privileges, ['id'=>$model->id]) !!}
        @endforeach
    </div>
</div>

@endsection
