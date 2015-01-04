<?php

class ManageUsersController extends AdminController {

	public function index()
	{
		$data_view = $this->data_view;

		// User and filtering
		$users = $this->filterData(new User)->paginate(10);

		$data_view['model'] = $users;

		return View::make('admin/users/index', compact('data_view'));
	}


	public function edit($id)
	{
		$data_view = $this->data_view;

		$user = User::findOrFail($id);
		$action = 'admin/users/'.$id;


		$data_view['model'] = $user;
		$data_view['action'] = $action;

		return View::make('admin/users/edit', compact('data_view'));
	}

	public function show($id)
	{
		$data_view = $this->data_view;

		$user = User::findOrFail($id);
	}

	public function update($id)
	{

		$validator = Validator::make(
		Input::all(),
		[
			'username'=>'required|min:6',
			'email'=>'required|email',
			'roles'=>'required|min:1|integer'
		], [
			'roles.min'=> 'Pilih salah satu role ya'
		]);


		if($validator->fails())
		{
			return Redirect::back()->withInput()->withErrors($validator->messages());
		}

		$user = User::find($id);
		$user->update(Input::except('roles'));

		// update rolenya juga
		$user->roles()->sync(array());
		$user->roles()->attach(Input::get('roles'));

		return Redirect::back()->with('success', 'user berhasil diperbarui!');
	}
	

}