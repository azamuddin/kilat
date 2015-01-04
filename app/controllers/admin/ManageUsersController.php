<?php



class ManageUsersController extends AdminController {


	public function index()
	{
		$data_view  = $this->data_view;

		// Siapkan Rapyd
		$user = DataEdit::source(new User);
		$user->add('username', 'Username', 'text');
		$user->add('email', 'Email', 'text');
		$user->add('password', 'Password', 'password');
		$user->add('password_confirmation', 'Password Confirmation', 'password');
		$user->add('code_confirmation', 'Password Confirmation', 'hidden')
			->insertValue(md5(uniqid(mt_rand(), true)));

		// Assign ke data_view
		$data_view['filter'] = '';
		$data_view['model'] = $user;

		return View::make('admin/manage_users', compact('data_view'));
	}



	public function lists()
	{
		$data_view = $this->data_view;

		// Siapkan User data
		$filter = DataFilter::source(new User);
		$filter->add('username', 'Username', 'text');
		$filter->build();

		$users = DataGrid::source($filter);
		$users->add('username', 'Username', 'text');
		$users->add('email', 'Email', 'text');
		$users->edit('users/manage','modify');
		$users->paginate(5);

		// Assign ke data_view
		$data_view['filter'] = $filter;
		$data_view['model'] = $users;

		return View::make('admin/manage_users', compact('data_view'));
	}
	

}