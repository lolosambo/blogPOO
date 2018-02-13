<?php

namespace P5\core\factories;

class TableFactory
{
	
	private $table;
	

	public function table($table)
	{	
		$majTable = ucfirst($table);
		$class = 'P5\\managers\\'.$majTable.'Manager';
		$this->table = new $class();
		return $this->table;
	}

}

