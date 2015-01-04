<?php

class ManageUsersController extends AdminController {

	public $filter = array('username'=>'', 'email'=>'');

	public function index()
	{
		$data_view = $this->data_view;

		// Catch filter
		if(Input::get('search'))
		{
			$this->filter = Input::except('search');
		}

		// User and filtering
		$users = User::orWhere(function($query)
		{
			foreach($this->filter as $criteria => $value)
			{
				if($value)
				{
					$query->where($criteria,"like", "%$value%");
				}
				
			}
		})->paginate(4);

		$users = $this->filterData(new User)->paginate(4);

		$data_view['model'] = $users;

		return View::make('admin/manage_users', compact('data_view'));
	}
	

}