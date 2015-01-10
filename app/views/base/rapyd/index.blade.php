@extends('base/admin')

@section('head')

@stop


@section('content')

	{{$data_view['filter']}}
	{{$data_view['grid']}}

@stop