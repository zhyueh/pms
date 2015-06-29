@extends('master')


@section('workspace')

<div style="width:80%;padding-left:auto;padding-right:auto">
    <div class="panel panel-primary test-result-panel">
        <div class="panel-heading">{{trans('title.testresult').trans('title.description')}}</div>
        <div class="panel-body">
            {!! display_custom_group_value("last_execute", trans('title.success'.$model->success)) !!}
            <form method="GET" action="{{action_url("getExecuteTestCase")}}">
                {!! csrf_field() !!}
                <input type="hidden" name="test_result_id" value="{{$model->id}}"></input>
                {!!display_form_group($model, "remark", [], false, 'textarea')!!}
                <button class="glyphicon glyphicon-ok" type="submit" name="success" value=""></button>
                <button class="glyphicon glyphicon-remove" type="submit" name="fail" value=""></button>
            </form>
        </div>
    </div>


    <div class="panel panel-info test-case-desc-panel">
        <div class="panel-heading">{{trans('title.testcase')}}{{trans('title.description')}}</div>
        <div class="panel-body">
            {!! display_group_value($test_case, "precondition", []) !!}
            {!! display_group_value($test_case, "test_step", []) !!}
        </div>
    </div>
</div>


@endsection
