@extends('master')

@section('sub-header-ext')
<div class="nav_version">
    <select id ="nav_versions" name='nav_versions' class='form-control'>
        @foreach ($versions as $id => $name )
        <option  value="{{ $id }}"
        @if ($id == $selected_version)
            selected='selected'
        @endif
        >{{$name}}</option>
        @endforeach
    </select>
</div>
<script type="text/javascript">
$("#nav_versions").change(function(){
    window.location = "{{ action_url("getIndex") }}" + "?version_id=" + $("#nav_versions").val();
});

</script>

@endsection
@section('workspace')

{{ $calendar->min_date }}
|
{{ $calendar->max_date }}
</br>
@if (!empty($calendar->min_date) && !empty($calendar->max_date))
{{ $calendar->min_date }}
|
{{ $calendar->max_date }}
@else
    empty
@endif

@endsection
