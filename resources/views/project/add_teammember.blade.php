@extends('master')

@section("module-helper-left")
<span>{{$team->project->project_name }}::{{ $team->team_name }}</span>
@endsection

@section('workspace')
<div>
<form method="POST" action="{{ action("$controller@postTeamMember") }}">
        <table class="pms-table" id="pms-table">
        {!! csrf_field() !!}
            <thead>
                <tr>
                    <th>{{trans('title.select')}}</th>
                    <th>{{trans('title.user')}}</th>
                    <input type="hidden" name="team_id" value="{{ $team->id}}"</input>
                <tr>
            </thead>
            <tbody>
@foreach($users as $user)
                <tr>
                    <td><input type="checkbox" name="user_{{$user->id}}" ></input></td>
                    <td><span>{{$user->name}}</span></td>
                </tr>
@endforeach
            </tbody>
        </table>
        <div class="col-sm-4 col-sm-offset-2">
            <button type="submit" class="btn btn-primary glyphicon glyphicon-saved">{{trans('title.submit')}}</button>
            <a href="{{ action("$controller@getIndex") }}" class="btn btn-default glyphicon glyphicon-remove">返回</a>
        </div>
    </form>

</div>
@endsection
