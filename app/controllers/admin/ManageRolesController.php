<?php

class ManageRolesController extends AdminController{
	use FilterFieldTrait;


	public function __construct()
	{
		$this->model = new Role;
	}

	public function index()
	{
		$data_view = $this->data_view;

		$filter = DataFilter::source($this->model);
		$filter->add('name', 'Name', 'text');
		$filter->build();

		$grid = DataGrid::source($filter);
		$grid->add('name', 'Name');
		$grid->edit('manage/roles', 'Action');
		$grid->paginate(10);
		$grid->link('admin/manage/roles', 'Add New Role', 'TR', array('class'=>'btn btn-primary'));

		$data_view['filter'] = $filter;
		$data_view['grid'] = $grid;

		return View::make('base/rapyd/index', compact('data_view'));

	}

	public function rapyd()
	{


		$data_view = $this->data_view;

		$edit = DataEdit::source($this->model);
		$edit->add('name', 'Name', 'text');
		$edit->add('permissions.permission_id', 'Permissions', 'checkboxgroup')->options(Permission::lists('display_name', 'id'));
		$edit->link('admin/roles', 'Role List', 'TR', array('class'=>'btn btn-primary'));


		// Don't allow super administrator and administrator role to be edited
		if(Input::get('modify') || Input::get('update') || Input::get('delete'))
		{

			$id = Input::get('modify') ? Input::get('modify') : Input::get('update');
			$id = $id ? $id : Input::get('delete');
			$role = $this->model->findOrFail($id);

			if(($role->name == "Super Administrator" || $role->name == "Administrator"))
			{
				if(Input::get('delete'))
				{
					return Redirect::back()
								->with('msg', 'This role can not be deleted')
								->with('msg-type', 'danger')
								->with('msg-timeout', true);
				}
				$edit->add('name', 'Name', 'text')->mode('readonly');
			}



		}

		$edit->saved(function() use($edit)
			{
				return Redirect::back()
						->with('msg', 'Successfully saved')
						->with('msg-type', 'success')
						->with('msg-timeout', true);
			});



		$data_view['edit'] = $edit;

		return $edit->view('base/rapyd/crud', compact('data_view'));

	}
}
?>