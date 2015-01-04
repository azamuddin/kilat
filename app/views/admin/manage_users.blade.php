@extends('base/admin')


@section('content')
	<h3>Manage Users</h3>
	<hr>
	{{$data_view['filter']}}
	{{$data_view['model']}}
@stop