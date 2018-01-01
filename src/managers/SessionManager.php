<?php

namespace p5\managers;

class SessionManager
{


	public function __construct()
	{
		session_start();
	}


	public function setSession($key, $value)
	{
		$_SESSION['$key'] = $value;
	}

	public function getSession($key)
	{
		return $_SESSION['$key'];
	}

	public function closeSession()
	{
		session_destroy();
	}
	

}