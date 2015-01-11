<?php

class ManageRolesController extends AdminController{
	use FilterFieldTrait;

	public $relation_fields = ["permissions", "user"];
	public $model;

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
		if(Input::get('modify') || Input::get('update'))
		{

			$id = Input::get('modify') ? Input::get('modify') : Input::get('update');
			$role = $this->model->findOrFail($id);

			if(($role->name == "Super Administrator" || $role->name == "Administrator"))
			{
				$edit->add('name', 'Name', 'text')->mode('readonly');
			}
		}



		$data_view['edit'] = $edit;

		return View::make('base/rapyd/crud', compact('data_view'));

	}




	// public function edit($id)
	// {
	// 	return "edit $id siap";
	// }

	// public function update($id)
	// {
	// 	return "update $id siap";
	// }

	// public function show($id)
	// {
	// 	return "show $id siap";
	// }

	// public function create()
	// {
	// 	return "create siap";
	// }

	// public function store()
	// {
	// 	return "store siap";
	// }

	// public function destroy($id)
	// {
	// 	return "destroy $id siap";
	// }
}
?>