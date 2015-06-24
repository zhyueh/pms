@extends('master')

@section("module-helper-right")
    <a class="glyphicon glyphicon-plus" href="#">{{ trans('title.create') }}</a>
@endsection

@section('workspace')

@include('base.create_and_update')

@endsection
