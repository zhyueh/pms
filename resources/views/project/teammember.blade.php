@extends('master')

@section("module-helper-left")
<span>{{$team->project->project_name }}::{{ $team->team_name }}</span>
@endsection

@section("module-helper-right")
<a class="btn btn-primary glyphicon glyphicon-plus" href="<?php echo action("$controller@getTeamMember")."?".http_build_query(["id"=>$team->id]);  ?>">{{ trans('title.create') }}</a>
@endsection


@section('workspace')

<div>
    <script type="text/javascript">
        function destroy(id){
            if(confirm("{{ trans('title.confirm_delete') }} => " + id))
            {
                window.location = "{{ action("$controller@getDestroyTeamMember")}}?team_id={{ $team->id }}&user_id="+ id;
            }
        }
    </script>
    <table class='pms-table' id='pms-table'>
        <thead>
            <tr>
                <th>{{trans('title.member_list')}}</th>
                <th>{{trans('title.operation')}}</th>
            <tr>
        </thead>
        <tbody>
@foreach ($team->member as $member)
            <tr>
                <td><span>{{ $member->name }}</span></td>
                <td>
                    <a class="btn btn-danger glyphicon glyphicon-trash" onclick="destroy({{ $member->id }});">{{ trans('title.destroy') }}</a>
                </td>
            </tr>
@endforeach
        </tbody>
    </table>
</div>

@endsection
