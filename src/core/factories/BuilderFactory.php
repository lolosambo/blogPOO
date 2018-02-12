<?php

namespace P5\core\factories;


class BuilderFactory
{

	private $builder;
	

	public function builder($builder)
	{	
		$majBuilder = ucfirst($builder);
		$class = 'P5\\core\\builders\\'.$majBuilder.'Builder';
		$this->builder = new $class();
		return $this->builder;
	}

}