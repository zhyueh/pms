@extends("master")

@section('reference_before_body')
<link rel="stylesheet" href="{{ base_url("asset/css/proj/view_bug.css") }}">
@endsection

@section("workspace")

<div class="panel panel-info bug-desc-panel">
    <div class="panel-heading">bug{{trans('title.description')}}</div>
    <div class="panel-body">
        {!! display_group_value($model, "version_name", $fields_enum) !!}
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

<div class="panel panel-info bug-comment-panel">
    <div class="panel-heading">bug{{trans('title.history')}}</div>
    <div class="panel-body bug-comment-list">
        @foreach ($model->historys as $history)
        <div class="bug-comment">
            <span>{{$history->created_at}},&nbsp;</span>
            <span>{{$history->created_user->name}}</span>
            <span>{{ trans('title.'.$history->operation)}}</span>
            @if (!empty($history->comment))
            <span>&nbsp;{{trans('title.comment').":".$history->comment}}</span>
            @endif
        </div>
        @endforeach
    </div>
</div>

<div class="panel panel-primary bug-commit-panel">
    <div class="panel-heading">bug{{trans('title.operation')}}</div>
    <div class="panel-body pms-bug-op">
        <form method="GET" action="{{action_url('getBugOp')}}">
            <input type="hidden" name="id" value="{{$model->id}}">
            <textarea class="form-control" name="comment"></textarea>
        @foreach ($operations as $operation)
            {!! create_submit($operation, $privileges) !!}
        @endforeach
        </form>
    </div>
</div>

@endsection
