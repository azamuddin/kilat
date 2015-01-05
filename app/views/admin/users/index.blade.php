@extends('base/admin')

@section('content_header')
	<h3>Edit User</h3>
@stop

@section('content')
<div class="row">
	<div class="col-lg-12 filter" style="margin-bottom:20px;">
		{{Form::open(array('url'=>'admin/users', 'method'=>'GET'))}}
		<div class="col-lg-3">
			{{Form::text('username', Input::get('username'), array('placeholder'=>'username', 'class'=>'form-control'))}}
		</div>
		<div class="col-lg-3">
			{{Form::text('email', Input::get('email'), array('placeholder'=>'email', 'class'=>'form-control'))}}
		</div>
		<div class="col-lg-3">
			{{Form::select('role', array('0'=>'All')+Role::lists('name', 'id'), Input::get('role'))}}
		</div>
		{{Form::hidden('search', 1)}}
		{{Form::submit('Go', array('class'=>'btn btn-primary '))}}
		{{Form::close()}}
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>Username</th>
					<th>Email</th>
					<th>Role</th>
				</tr>
			</thead>
			<tbody>
			@foreach($data_view['model'] as $user)
				<tr>
					<td>
						{{$user->username}}
					</td>
					<td>
						{{$user->email}}
					</td>
					<td>
						@foreach($user->roles as $role)
							<span class="label label-primary">{{$role->name}}</span> <br/>
						@endforeach
					</td>
				</tr>
			@endforeach
			</tbody>
			<tfoot>
				<tr>
					<th colspan="3">
						{{$data_view['model']->links()}}
					</th>
				</tr>
			</tfoot>
		</table>
	</div>
</div>
@stop