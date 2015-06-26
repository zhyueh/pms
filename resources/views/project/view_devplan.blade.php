@extends('master')

@section('reference_before_body')
<link rel="stylesheet" href="{{ base_url("asset/css/proj/view.devplan.css") }}">
@endsection

@section('workspace')

<div class="devplan-left-panel">
    <div class="panel panel-primary story-desc-panel">
      <div class="panel-heading">{{trans('title.story')}}{{trans('title.description')}}</div>
      <div class="panel-body">
            {!! display_group_value($story, "description", $fields_enum) !!}
            {!! display_group_value($story, "requirement", $fields_enum) !!}
    
      </div>
    </div>

    <div class="panel panel-primary story-comments-panel">
        <div class="panel-heading">{{trans('title.story').trans('title.comment')}}</div>
        <div class="panel-body">
            <table class="pms-table story-comments-table">
                <thead>
                    <tr>
                        <th>{{trans('title.team_name')}}</th>
                        <th>{{trans('title.work_hour')}}</td>
                        <th>{{trans('title.difficult')}}</td>
                        <th width="50%">{{trans('title.description')}}</td>
                        <th>{{trans('title.updated')}}</th>
                    </tr>
                <thead>
                <tbody>
                @foreach ($story_comments as $comment)
                    <tr>
                        <td>{{ display_value($comment, "team_name", $fields_enum) }}</td>
                        <td>{{ $comment->work_hour }}</td>
                        <td>{{ $comment->difficult}}</td>
                        <td>{!! $comment->description !!}</td>
                        <td>{{ display_value($comment, "updated", $fields_enum) }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="panel panel-primary remark-panel">
        <div class="panel-heading">{{trans('title.remark')}}</div>
        <div class="panel-body">
            <form method="POST" action="{{action_url('postRemark')}}">
                {!! csrf_field() !!}
                <input type="hidden" name="id" value="{{ $model->id }}">
                {!! display_form_group($model, 'remark', [], false, 'textarea')!!}
                <button class="btn btn-primary" type="submit">{{trans('title.submit').trans('title.remark')}}</button>
                
            </form>
        </div>    
    </div>
        
</div>

<div class="devplan-right-panel">
    <div class="panel panel-warning devplan-info-panel">
      <div class="panel-heading">{{trans('title.devplan').trans('title.info')}}</div>
      <div class="panel-body">
            {!! display_group_value($model, "id", $fields_enum ) !!} 
            {!! display_group_value($story, "story_name", $fields_enum) !!} 
            {!! display_group_value($model, "plan_start_at", []) !!} 
            {!! display_group_value($model, "plan_complete_at", []) !!} 
            {!! display_group_value($model, "status_name", $fields_enum) !!} 
            {!! display_group_value($model, "priority_name", $fields_enum) !!} 
      </div>
    </div>
</div>

<div class="clear"></div>


@endsection
