<?php

class AdminController extends \BaseController {

	protected $data_view;
	protected $filter = array();

	public function __construct()
	{
		$this->data_view = array();
	}


	protected function filterData($model)
	{

		// Tangkap filter
		if(Input::get('search'))
		{
			$this->filter = Input::except('search', 'role');
		}

		if(Input::get('role'))
		{
			$result = $model::whereHas('roles', function($query)
			{
				$query->where('roles.id', '=', Input::get('role'));
			})

			->where(function($query)
			{
				foreach($this->filter as $criteria => $value)
				{
					if($value)
					{
						$query->where($criteria,"like", "%$value%");
					}
					
				}
			});
		}
		else
		{
			$result = $model->where(function($query)
			{
				foreach($this->filter as $criteria => $value)
				{
					if($value)
					{
						$query->where($criteria,"like", "%$value%");
					}
					
				}
			});
		}



		return $result;
	}
	

}