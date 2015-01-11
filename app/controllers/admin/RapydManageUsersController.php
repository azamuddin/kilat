<?php

class RapydManageUsersController extends AdminController {

	public function __construct()
	{
		$this->model = new User;
	}

	/**
	 * Display a listing of the resource.
	 * GET /admin/rapydmanageuser
	 *
	 * @return Response
	 */
	public function index()
	{
		$data_view = $this->data_view;

		$filter = DataFilter::source($this->model->with('roles'));
		$filter->add('username', 'Username', 'text');
		$filter->add('email', 'Email', 'text');
		$filter->add('roles.name', 'Roles', 'select')->options([null=>'All']+Role::lists('name', 'name'));
		$filter->submit('go');
		$filter->build();

		$grid = DataGrid::source($filter);
		$grid->add('username', 'Username');
		$grid->add('email', 'Email');
		$grid->add('confirmed', 'Confirmed?')->cell(function($value) 
			{
				$value = ($value == 1) ? "<span class='label label-success'>yes</span>" : "<span class='label label-danger'>no</span>";
				return $value;
			});
		$grid->edit('manage/users', 'Action');
		$grid->add('{{$id}}', 'Confirm action')->cell(function($value)
			{
				$status = User::find($value)->confirmed;
				$return = ($status == 1) ? "<a href='manage/users/toggle_confirm/$value' class='btn btn-xs btn-danger'>unconfirm</a>" : "<a href='manage/users/toggle_confirm/$value' class='btn btn-xs btn-success'>confirm</a>";
				return $return;
			});
		$grid->link('admin/manage/users/', 'Add New User', 'TR', array('class'=>'btn btn-primary'));

		$data_view['filter'] = $filter;
		$data_view['grid'] = $grid;

		return View::make('base/rapyd/index', compact('data_view'));
	}

	/**
	 * Rapyd Controller
	 *
	 */
	public function rapyd()
	{
		$data_view = $this->data_view;

		
		if(Input::get('modify') || Input::get('update'))
		{
			$id = Input::get('modify') ? Input::get('modify') : Input::get('update');
			$user = User::find($id);


			// Administrator are not allowed to edit other administrator
			if(Auth::user()->hasRole('Administrator') && $user->hasRole('Administrator'))
			{
				return Redirect::to("admin/manage/users?show=$id")
							->with('msg', 'Administrator are not allowed to edit other Administrator')
							->with('msg-type', 'danger')
							->with('msg-timeout', true);
			}

			// If super admin, don't allow to be edited
			if($user->username == 'superadmin')
			{
				return Redirect::to("admin/manage/users?show=$id");
			}
		}


		$edit = DataEdit::source($this->model);
		$edit->add('username', 'Username', 'text')->rule('required|min:5|max:30');
		$edit->add('email', 'Email', 'text')->rule('email');
		$edit->add('roles.name', 'Role', 'checkboxgroup')->options(Role::lists('name', 'id'))->rule('required');

		$edit->link('admin/users', 'User List', 'TR', array('class'=>'btn btn-primary'));

		$edit->saved(function() use ($edit)
		{
			return Redirect::back()
					->with('msg', 'Successfully saved')
					->with('msg-type', 'success')
					->with('msg-timeout', true);
		});

		$data_view['edit'] = $edit;
		return $edit->view('base/rapyd/crud', compact('data_view'));

	}





	public function toggleConfirm($id)
	{
		$user = User::findOrFail($id);
		$status = $user->confirmed;

		if($status)
		{
			$user->confirmed = 0;
			if($user->save())
			{
				return Redirect::back()
						->with('msg', 'User successfully unconfirmed')
						->with('msg-type', 'success')
						->with('msg-timeout', true);
			}
			else
			{
				return Redirect::back()
						->with('msg', 'There\'s an error' )
						->with('msg-type', 'danger')
						->with('msg-timeout', true);
			}

		}
		else
		{
			$user->confirmed = 1;
			if($user->save())
			{
				return Redirect::back()
						->with('msg', 'User successfully confirmed')
						->with('msg-type', 'success')
						->with('msg-timeout', true);
			}
			else
			{
				return Redirect::back()
						->with('msg', 'There\'s an error' )
						->with('msg-type', 'danger')
						->with('msg-timeout', true);
			}

		}

	}
}