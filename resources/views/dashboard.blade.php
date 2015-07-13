@extends('master')

@section('workspace')

<div class="pms-main-panel">
    <div class="panel panel-primary">
        <div class="panel-heading">
            {{trans('title.project').trans('title.summary')}}
        </div>
        <div class="panel-body"> 
            <table class="pms-table pms-panel-table">
                <thead>
                    <tr>
                        <th>{{trans('title.project')}}</th>
                        <th>{{trans('title.version_name')}}</th>
                        <th>{{trans('title.story')}}</th>
                        <th>{{trans('title.dev_plan')}}</th>
                        <th>{{trans('title.completed').trans('title.dev_plan')}}</th>
                        <th>{{trans('title.test_case')}}</th>
                        <th>bug</th>
                        <th>{{trans('title.fixed_bug')}}</th>
                        <th>{{trans('title.closed_bug')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($versions as $version)
                    <tr>
                        <td>{{$version->project->project_name}}</td>
                        <td>{{$version->version_name}}</td>
                        <td>{{count($version->storys)}}</td>
                        <td>{{$version->dev_plan_num}}</td>
                        <td>{{$version->completed_plan_num}}</td>
                        <td>{{count($version->test_cases)}}</td>
                        <td>{{$version->bugs}}</td>
                        <td>{{$version->fix_bugs}}</td>
                        <td>{{$version->close_bugs}}</td>
                    </tr>
                    @endforeach
                    @for ($i = count($versions); $i < 5; $i++)
                    <tr>
                    @for ($j= 0; $j < 8; $j++)
                        <td>&nbsp;</td>
                    @endfor
                    </tr>
                    @endfor
                </tbody>
            </table>
        </div>
    </div>

    <div class="panel panel-primary">
        <div class="panel-heading">
            {{trans('title.today').trans('title.dev_plan')}}
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
                    @for ($i = count($plans); $i < 5; $i++)
                    <tr>
                    @for ($j= 0; $j < 3; $j++)
                        <td>&nbsp;</td>
                    @endfor
                    </tr>
                    @endfor
                </tbody>
            </table>
        </div>
    </div>
    <div class="panel panel-primary">
        <div class="panel-heading">
            {{trans('title.today').'bug'}}
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
                @for ($i = count($bugs); $i < 5; $i++)
                <tr>
                @for ($j= 0; $j < 2; $j++)
                    <td>&nbsp;</td>
                @endfor
                </tr>
                @endfor
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
