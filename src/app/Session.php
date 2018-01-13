<?php
namespace p5\app;

class Session
{


	public function startSession()
	{
		session_cache_limiter('private_no_expire, must-revalidate');
		session_start();
	}


	public function setSession($key, $value)
	{
		
		$_SESSION[$key] = $value;

	}

	public function getSessionVar($key)
	{
		if(isset($_SESSION[$key]))
		{
			return $_SESSION[$key];
		}
		else
		{
			return FALSE;
		}
	}

	public function closeSession()
	{
		session_destroy();
		
		
	}


	

}