<div>
    {!! insert_destroy_script() !!}
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
                <th colspan="<?php echo count($operations); ?>">{{ trans("title.operation") }}</th>
            </tr>
        </thead>
        <tbody>
                @foreach ($models as $m)
                <tr>
                    @foreach ($fields_show as $f)
                    <td>{{ display_value($m, $f, $fields_enum) }}</td>
                    @endforeach
                    @foreach ($operations as $operation)

                    <td>
                    @if ($operation->name != 'destroy')
                        {!! create_button($operation, [], ['id'=>$m->id] )!!}
                    @else
                        <a class="btn btn-danger glyphicon glyphicon-trash" onclick="destroy({{ $m->id }});">{{ trans('title.destroy') }}</a>
                    @endif
                    </td>

                    @endforeach
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
