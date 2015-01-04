<?php

class ManageUsersController extends AdminController {

	public function index()
	{
		$data_view = $this->data_view;

		// User and filtering
		$users = $this->filterData(new User)->paginate(10);

		$data_view['model'] = $users;

		return View::make('admin/manage_users', compact('data_view'));
	}
	

}