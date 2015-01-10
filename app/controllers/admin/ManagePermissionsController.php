<?php

class ManagePermissionsController extends AdminController {

	public function __construct()
	{
		$this->model = new Permission;
	}
	/**
	 * Display a listing of the resource.
	 * GET /admin/managepermissions
	 *
	 * @return Response
	 */
	public function index()
	{
		$data_view = $this->data_view;

		$filter = DataFilter::source($this->model->with('roles'));
		$filter->add('display_name', 'Name', 'text');
		$filter->add('roles.name', 'Roles', 'select')->options(Role::lists('name', 'name'));
		$filter->submit('go');
		$filter->build();

		$grid = DataGrid::source($filter);
		$grid->add('display_name', 'Permission Name');
		$grid->edit('manage/permissions', 'Action');

		$data_view['filter'] = $filter;
		$data_view['grid'] = $grid;

		return View::make('base/rapyd/index', compact('data_view'));

	}


	/**
	 * Special controller for Rapyd Development
	 *
	 */
	public function rapyd()
	{
		$data_view = $this->data_view;

		$edit = DataEdit::source($this->model);
		$edit->add('name', 'Name', 'text');
		$edit->add('display_name', 'Display Name', 'text');

		$data_view['edit'] = $edit;

		return View::make('base/rapyd/crud', compact('data_view'));
	}

}