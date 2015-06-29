@extends('master')

@section('reference_before_body')

<link rel="stylesheet" href="{{ base_url("asset/css/proj/test.plan.summary.css") }}">

@endsection

@section('workspace')

<div style="width:80%;margin-left:10%;">
<div class="test-plan-summary">
    <div class="panel panel-primary">
        <div class="panel-heading">{{trans('title.testplan').trans('title.summary')}}</div>
        <div class="panel-body">
            {!! display_custom_group_value('total', $test_result_count) !!}
            {!! display_custom_group_value('passed', count($passed_results)) !!}
            {!! display_custom_group_value('failed', count($failed_results)) !!}
            
        </div>
    </div>
</div>

<div class="panel panel-info test-failed-result">
    <div class="panel-heading">{{trans('title.failed')}}</div>
    <div class="panel-body">
        <table class="pms-table test-result-table">
            <thead>
                <tr>
                    <td>{{trans("title.id")}}</td>
                    <td>{{trans("title.test_case_name")}}</td>
                    <td>{{trans("title.remark")}}</td>
                    <td>{{trans("title.operation")}}</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($failed_results as $test_result)
                <tr>
                    <td>{{ $test_result->id }}</td>
                    <td>{{ $test_result->test_case->test_case_name}} </td>
                    <td>{{ $test_result->remark }}</td>
                    <td>
                        <a class="btn btn-primary glyphicon glyphicon-ok" href="{{action_url("getUpdateTestResult", ['id'=>$test_result->id])}}"></a>
                        <a class="btn btn-primary glyphicon glyphicon-zoom-in" href="{{action_url("Project\TestCaseController@getEdit", ["id"=>$test_result->test_case->id])}}"></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="panel panel-info test-success-result">
    <div class="panel-heading">{{trans('title.passed')}}</div>
    <div class="panel-body">
        <table class="pms-table test-result-table">
            <thead>
                <tr>
                    <td>{{trans("title.id")}}</td>
                    <td>{{trans("title.test_case_name")}}</td>
                    <td>{{trans("title.remark")}}</td>
                    <td>{{trans("title.operation")}}</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($passed_results as $test_result)
                <tr>
                    <td>{{ $test_result->id }}</td>
                    <td>{{ $test_result->test_case->test_case_name}} </td>
                    <td>{{ $test_result->remark }}</td>
                    <td>
                        <a class="btn btn-primary glyphicon glyphicon-remove" href="{{action_url("getUpdateTestResult", ['id'=>$test_result->id])}}"></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

</div>

@endsection
