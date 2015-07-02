@extends('master')

@section('sub-header-ext')
<div class="nav_project">
    <select id="nav_projects" name='nav_projects' class='form-control'>
        @foreach ($nav_projects as $id=>$name)
        <option  value="{{ $id }}"
        @if($nav_default_version && ($name == $nav_default_version->project->project_name))
            selected='selected'
        @endif
        >{{$name}}</option>
        @endforeach
    </select>
</div>

@if (!isset($hide_nav_version) && $nav_default_version)
<div class="nav_version">
    <select id ="nav_versions" name='nav_versions' class='form-control'>
        @foreach ($nav_versions as $version )
        <option  value="{{ $version->id }}"
        @if ($version->id == $nav_default_version->id)
            selected='selected'
        @endif
        >{{$version->version_name}}</option>
        @endforeach
    </select>
</div>
@endif 
<script type="text/javascript">
$("#nav_projects").change(function(){
    window.location = "{{ action_url("getIndex") }}" + "?project_id=" + $("#nav_projects").val();
});

$("#nav_versions").change(function(){
    window.location = "{{ action_url("getIndex") }}" + "?version_id=" + $("#nav_versions").val();
});

</script>

@endsection

@section("module-helper-left")
    <ol class="pms-filter">
        <li class="pms-filter-item"> <a href="{{action_url('getIndex')}}">{{ trans('title.all') }}</a></li>
    @foreach ($filter_list as $k=>$v)
        <li class="pms-filter-item"> <a href="{{action_url('getIndex', ['filter'=>$k])}}">{{ trans('title.'.$k) }}</a></li>
    @endforeach
    </ol>
@endsection

@section("module-helper-right")
   {!! create_button($create_btn, $privileges, [])!!}
@endsection

@section('workspace')

@yield('project-workspace')
@include('base.table')
@endsection

@endsection
