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
		$grid->edit('manage/users', 'Action');

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
		$edit = DataEdit::source($this->model);
		$edit->add('username', 'Username', 'text')->rule('required|min:5|max:30');
		$edit->add('email', 'Email', 'text')->rule('email');
		$edit->add('roles.name', 'Role', 'checkboxgroup')->options(Role::lists('name', 'id'))->rule('required');
		// $edit->add('password', 'Password', 'password');
		// $edit->add('password_confirmation', 'Password Confirmation', 'password');

		$data_view['edit'] = $edit;

		return View::make('base/rapyd/crud', compact('data_view'));

	}
}