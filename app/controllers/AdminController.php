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
			$this->filter = Input::except('search');
		}

		$result = $model::orWhere(function($query)
		{
			foreach($this->filter as $criteria => $value)
			{
				if($value)
				{
					$query->where($criteria,"like", "%$value%");
				}
				
			}
		});

		return $result;
	}
	

}