@extends('base/admin')

@section('content_header')
	<h3>Edit User</h3>
	@parent
@stop

@section('content')

<div class="row">
	<div class="col-lg-4">
		{{Form::open(array('url'=>$data_view['action'], 'method'=>'PUT'))}}
		{{Form::label('username', 'Username')}}
		{{Form::text('username', $data_view['model']->username, array('class'=>'form-control'))}}
		<br/>
		{{Form::label('email', 'Email')}}
		{{Form::text('email', $data_view['model']->email, array('class'=>'form-control'))}}
		<br/>
		{{Form::label('roles', 'Roles')}}
		<br/>
		{{Form::select('roles', array('0'=>'Select Role')+Role::lists('name', 'id') , count($data_view['model']->roles) ? $data_view['model']->roles[0]->id : 0, [])}}
		<br/>
		<br/>
		{{Form::submit('Simpan', ['class'=>'btn btn-primary'])}}
		{{Form::close()}}
	</div>
</div>
@stop