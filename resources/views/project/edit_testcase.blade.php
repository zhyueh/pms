@extends('master')

@section('reference_before_body')
<link rel="stylesheet" href="{{ base_url("asset/css/proj/edit_testcase.css") }}">
@endsection

@section('workspace')

<div class="testcase-left-panel">
    <div class="panel panel-primary testcase-desc-panel">
        <div class="panel-heading">{{trans('title.test_case').trans('title.description')}}</div>
        <div class="panel-body">
            <div class="">
                <form method="POST" action="{{action("$controller@postStore")}}">
                    {!! csrf_field() !!}
                    @if ($action != 'getCreate' && $action != 'postCreate')
                    <div class="form-group">
                        <label for "id">{{trans("title.id")}}</label>
                        <input name="id" type="text" readonly class="form-control" value="{{ $model->id }}"></input>
                    </div>
                    @endif

                    {!! display_form_group($model, 'test_case_name', $fields_enum, $action == 'getShow')!!}
                    {!! display_form_group($model, 'test_case_type', $fields_enum, $action == 'getShow')!!}
                    {!! display_form_group($model, 'story_name', $fields_enum, $action == 'getShow')!!}
                    {!! display_form_group($model, 'precondition', $fields_enum, $action == 'getShow', 'textarea')!!}
                    {!! display_form_group($model, 'test_step', $fields_enum, $action == 'getShow', 'html')!!}
                    {!! display_form_group($model, 'test_sequence', $fields_enum, $action == 'getShow')!!}
                    {!! display_form_group($model, 'remark', $fields_enum, $action == 'getShow', 'textarea')!!}

                    @if ($action != 'getShow')
                    <div class="col-sm-4 col-sm-offset-2">
                        <button type="submit" class="btn btn-primary glyphicon glyphicon-saved">提交</button>
                        <a href="{{ action("$controller@getIndex") }}" class="btn btn-default glyphicon glyphicon-remove">返回</a>
                    </div>
                    @endif
                </form>
            </div>
        </div>
    </div>

    @if (isset($story))
    <div class="panel panel-info story-desc-panel">
        <div class="panel-heading">{{trans('title.story').trans('title.description')}}</div>
        <div class="panel-body">
            {!! display_group_value($story, 'description', []) !!}
            {!! display_group_value($story, 'requirement', []) !!}
        </div>
    </div>

    <div class="panel panel-info story-comments-panel">
        <div class="panel-heading">{{trans('title.story').trans('title.comment')}}</div>
        <div class="panel-body">
            <table class="pms-table story-comments-table">
                <thead>
                    <tr>
                        <th>{{trans('title.team_name')}}</th>
                        <th>{{trans('title.work_hour')}}</td>
                        <th>{{trans('title.difficult')}}</td>
                        <th width="50%">{{trans('title.description')}}</td>
                    </tr>
                <thead>
                <tbody>
                @foreach ($story_comments as $comment)
                    <tr>
                        <td>{{ display_value($comment, "team_name", $fields_enum) }}</td>
                        <td>{{ $comment->work_hour }}</td>
                        <td>{{ $comment->difficult}}</td>
                        <td>{!! $comment->description !!}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif

</div>




<div class="clear"></div>


@endsection
