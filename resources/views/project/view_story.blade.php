@extends('master')

@section('reference_before_body')
<link rel="stylesheet" href="{{ base_url("asset/css/proj/view.story.css") }}">
@endsection

@section('workspace')

<div class="story-left-panel">
    <div class="panel panel-primary story-desc-panel">
      <div class="panel-heading">{{trans('title.story')}}{{trans('title.description')}}</div>
      <div class="panel-body">
            {!! display_group_value($model, "description", $fields_enum) !!}
            {!! display_group_value($model, "requirement", $fields_enum) !!}
    
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
                        <th colspan=2>{{trans('title.operation')}}</th>
                    </tr>
                <thead>
                <tbody>
                <?php $index = 1; $work_hours = 0; $difficult = 0; ?>
                @foreach ($comments as $comment)
                    <tr>
                        <td>{{ display_value($comment, "team_name", $fields_enum) }}</td>
                        <td>{{ $comment->work_hour }}</td>
                        <td>{{ $comment->difficult}}</td>
                        <td>{!! $comment->description !!}</td>
                        <td>{{ display_value($comment, "updated", $fields_enum) }}</td>
                        <td><a class="btn btn-default" href="{{ action_url("Project\StoryController@getViewStory", ['id'=>$model->id, 'comment_id'=>$comment->id])}}"> {{trans('title.edit')}}</a></td>
                        <td><a class="btn btn-danger" href="{{ action_url("Project\StoryCommentController@getDestroy", ['id'=>$comment->id])}}"> {{trans('title.destroy')}}</a></td>
                    </tr>
<?php $index += 1; $work_hours += $comment->work_hour; $difficult += $comment->difficult; ?>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
        

    <div class="panel panel-primary story-comment-panel">
      <div class="panel-heading">{{trans('title.new').trans('title.story').trans('title.comment')}}</div>
      <div class="panel-body">
            <div class="">
                <form method="POST" action="{{action("Project\StoryCommentController@postStore")}}">
                    {!! csrf_field() !!}
                    {!! display_form_group($new_comment, 'team_name', $fields_enum) !!}
                    {!! display_form_group($new_comment, 'description', [], false, 'html') !!}
                    {!! display_form_group($new_comment, 'work_hour', $fields_enum) !!}
                    {!! display_form_group($new_comment, 'difficult', $fields_enum) !!}
                    
                    <input type="hidden" name="story_id" value="{{$model->id}}">
                    @if ($new_comment->id > 0)
                    <input type="hidden" name="id" value="{{$new_comment->id}}">
                    @endif
                    <div class="col-sm-4 col-sm-offset-2">
                        <button type="submit" class="btn btn-primary glyphicon glyphicon-saved">{{trans('title.submit')}}</button>
                    </div>
        <script type="text/javascript">
            UE.getEditor('description_ueditor');
        </script>
                    
                </form>
            </div>
      </div>
    </div>
</div>

<div class="story-right-panel">
    <div class="panel panel-warning story-info-panel">
      <div class="panel-heading">{{trans('title.story').trans('title.info')}}</div>
      <div class="panel-body">
            {!! display_group_value($model, "id", $fields_enum ) !!} 
            {!! display_group_value($model, "story_name", $fields_enum ) !!} 
            {!! display_group_value($model, "project_name", $fields_enum) !!} 
            {!! display_group_value($model, "module_name", $fields_enum) !!} 
            {!! display_group_value($model, "version_name", $fields_enum) !!} 
            {!! display_group_value($model, "status_name", $fields_enum) !!} 
            {!! display_group_value($model, "priority_name", $fields_enum) !!} 
            {!! display_group_value($model, "created", $fields_enum) !!} 
            {!! display_group_value($model, "updated", $fields_enum) !!} 
      </div>
    </div>

    <div class="panel panel-warning story-history-panel">
        <div class="panel-heading">{{trans('title.story')}}{{trans('title.history')}}</div>
        <div class="panel-body">
        </div>

    </div>
    <div class="panel panel-warning story-history-panel">
        <div class="panel-heading">{{trans('title.story').trans('title.comment').trans('title.summary')}}</div>
        <div class="panel-body">
            <div class="story-comments-summary">
            @if (count($comments) == 0)
            @else
                <div>{{ trans('title.comment').trans('title.count')}}:{{count($comments)}}</div>
                <div>{{ trans('title.avg').trans('title.difficult') }}:{{ ceil($difficult/count($comments)) }}</div>
            @endif
            </div>
        </div>
    </div>

    <div class="panel panel-warning story-operation-panel">
        <div class="panel-heading">{{trans('title.dev_plan').trans('title.operation')}}</div>
        <div class="panel-body">
            <form method="POST" action="{{ action("Project\DevPlanController@postCreate") }}">
                {!! csrf_field() !!}
                {!! display_form_group($project, 'team_name', $fields_enum) !!}
                <input type="hidden" name="story_id" value="{{$model->id}}" ></input>
            <button class="btn btn-primary" type="submit">{{trans('title.create').trans('title.dev_plan')}}</button>

            </form>
        </div>
    </div>
</div>

<div class="clear"></div>


@endsection
