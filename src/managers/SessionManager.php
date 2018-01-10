<?php

namespace p5\traits;

trait SessionManager
{

	public function setSession($key, $value)
	{
		$_SESSION[$key] = $value;
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