<?php

trait FilterFieldTrait{

	public $relation_filter;

	public function getFilteredData()
	{
		$this->catchFilters();

		return dd($this->model);

		// if($this->relation_filter)
		// {
		// 	return $this->model->orWhere(function($query)
		// 	{
		// 		foreach($this->relation_filter as $filter => $value)
		// 		{
		// 			if($value)
		// 			{
		// 				$query->whereHas($filter, function($q) use ($filter, $value)
		// 				{
		// 					return $q->where("$filter.id", "=", $value);
		// 				});
		// 			}
		// 		}
		// 	})->get();
		// }
		// else 
		// {

		// }
	}


	protected function catchFilters()
	{
		$input = Input::except('search');

		foreach(Input::all() as $input => $value)
		{
			if(in_array($input, $this->relation_fields))
			{
				$this->relation_filter[$input] = $value;
			}
		}
	}

}

?>