@extends("master")

@section("workspace")



<div class="pms-edit-table">
    <form method="POST" action="{{action("$controller@postStore")}}">
        {!! csrf_field() !!}
        @if ($action != 'getCreate' && $action != 'postCreate')
        <div class="form-group">
            <label for "id">{{trans("title.id")}}</label>
            <input name="id" type="text" readonly class="form-control" value="{{ $model->id }}"></input>
        </div>
        @endif

        {!! display_form_group($model, "test_case_name", $fields_enum) !!}
        {!! display_form_group($model, "bug_name", []) !!}
        {!! display_form_group($model, "team_name", $fields_enum) !!}
        {!! display_form_group($model, "owner", $fields_enum) !!}
        {!! display_form_group($model, "description", [], false, 'html') !!}
        {!! display_form_group($model, "requirement", [], false, 'html') !!}
        {!! display_form_group($model, "status", $fields_enum) !!}
        {!! display_form_group($model, "serverity", $fields_enum) !!}
        {!! display_form_group($model, "priority", $fields_enum) !!}

        @if ($action != 'getShow')
        <div class="col-sm-4 col-sm-offset-2">
            <button type="submit" class="btn btn-primary glyphicon glyphicon-saved">提交</button>
            <a href="{{ action("$controller@getIndex") }}" class="btn btn-default glyphicon glyphicon-remove">返回</a>
        </div>
        @endif
    </form>

</div>

@endsection
