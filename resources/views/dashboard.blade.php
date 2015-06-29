@extends('master')

@section('workspace')

<div class="pms-main-panel">
    <div class="panel panel-primary">
        <div class="panel-heading">
            {{trans('title.project').trans('title.summary')}}
        </div>
        <div class="panel-body"> 
        </div>
    </div>

    <div class="panel panel-primary">
        <div class="panel-heading">
            {{trans('title.my').trans('title.dev_plan')}}
        </div>
        <div class="panel-body"> 
            <table class="pms-table pms-panel-table">
                <thead>
                    <tr>
                        <th>{{trans('title.id')}}</th>
                        <th>{{trans('title.name')}}</th>
                        <th>{{trans('title.plan_start_at')}}</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($plans as $plan)
                    <tr>
                        <td>{{$plan->id}}</td>
                        <td>
                            <a href="{{ action_url("Project\DevPlanController@getViewDevPlan", ['id'=>$plan->id]) }}">{{$plan->story->story_name}}</a>
                        </td>
                        <td>{{$plan->plan_start_at}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="panel panel-primary">
        <div class="panel-heading">
            {{trans('title.my').'bug'}}
        </div>
        <div class="panel-body"> 
            <table class="pms-table pms-panel-table">
                <thead>
                    <tr>
                        <th>{{trans('title.id')}}</th>
                        <th>{{trans('title.bug_name')}}</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($bugs as $bug)
                    <tr>
                        <td>{{$bug->id}}</td>
                        <td>
                            <a href="{{ action_url("Project\BugController@getShow", ['id'=>$bug->id]) }}">{{$bug->bug_name}}</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="pms-right-panel">
    <div class="panel panel-info">
        <div class="panel-heading">
            {{trans('title.history')}}
        </div>
        <div class="panel-body"></div>
    </div>

</div>

<div class="clear"></div>


@endsection
