<?php

namespace p5\traits;

trait SessionTrait
{

	public function setSession($key, $value)
	{
		$_SESSION[$key] = $value;
		return $_SESSION[$key];
	}

	public function getSession($key)
	{
		return $_SESSION[$key];
	}

	public function closeSession()
	{
		session_destroy();
		
	}
	

}