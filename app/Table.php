<?php 


/**
 * Check for filled and empty table fields
 */
class Table
{
	//
	public function __construct($completed = false)
	{
		// code...
	}

	//
	public static function fields($data = [])
	{
		if (empty($data)) {
			throw new Exception('Table data cannot be empty');
		}

		foreach($data as $field) {}
	}
}