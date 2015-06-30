@extends('project.indexbase')

@section('notification')

{{ trans('message.dev_plan_create_from_story') }}

@endsection

@section('workspace')
<div>
    <table class="pms-table" id="pms-table">
        <thead>
            <tr>
                @foreach ($fields_show as $f)
                <th>
<?php 
    $sort_name = $f;
    if (array_key_exists($sort_name, $fields_enum))
    {
        $sort_field = $fields_enum[$sort_name]["field"];
    }else{
        $sort_field = $f;
    }
?>
                    @if ($sort == $sort_field && $sort_type == 'desc')
                        <a class="glyphicon glyphicon-sort-by-attributes-alt" href="{{ action_url("$controller@getIndex",["sort"=>$sort_field, "sort_type"=>'asc'])}}" >{{ trans("title.$f") }}</a>
                    @elseif ($sort == $sort_field && $sort_type == 'asc')
                        <a class="glyphicon glyphicon-sort-by-attributes" href="{{ action("$controller@getIndex")."?".http_build_query(["sort"=>$sort_field, "sort_type"=>'desc'])}}" >{{ trans("title.$f") }}</a>
                    @else
                        <a class="glyphicon glyphicon-sort" href="{{ action("$controller@getIndex")."?".http_build_query(["sort"=>$sort_field, "sort_type"=>'desc'])}}" >{{ trans("title.$f") }}</a>
                    @endif
                </th>
                @endforeach
                <th>{{ trans("title.operation") }}</th>
            </tr>
        </thead>
        <tbody>
                @foreach ($models as $m)
                <tr>
                    @foreach ($fields_show as $f)
                    <td>
                    @if ($f=='id')
                        <a href="{{ action_url(gen_action('getViewDevPlan'), ['id'=>$m->id]) }}">{{ display_value($m, $f, $fields_enum) }}</a>
                    @else
                        {{ display_value($m, $f, $fields_enum) }}
                    @endif
                    </td>
                    @endforeach
                    <td>

                    @if (empty($m->start_at))
                        {!! create_button($operations['start'], [], ['id'=>$m->id], true)!!}
                    @elseif (empty($m->complete_at))
                        {!! create_button($operations['complete'], [], ['id'=>$m->id], true)!!}
                    @endif

                    @if (!empty($m->start_at) || !empty($m->complete_at))
                        {!! create_button($operations['refresh'], [], ['id'=>$m->id], true)!!}
                    @endif

                        {!! create_button($operations['edit'], [], ['id'=>$m->id] )!!}

                    </td>
                </tr>
                @endforeach
        </tbody>
    </table>
    <div class="pms-paginate">
        @if (count($models) != 0)
        <span class="pms-paginate-total" >总记录数:{{ $models->total() }} </span>
        <span class="pms-paginate-current" >当前页记录数:{{ $models->count() }} </span>
        <span class="pms-paginate-pages" >总页数:{{ $models->lastPage() }} </span>
        {!! $models->appends(['sort'=>$sort, 'sort_type'=>$sort_type])->render() !!}
        <div class="clear"></div>
        @endif
    </div>
</div>

@endsection
