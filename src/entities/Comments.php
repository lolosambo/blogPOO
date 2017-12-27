<?php


namespace blog\entities;


class Comments
{

	private $id_user;
	private $id_post;
	private $comment_content;
	private $comment_date;
	private $comment_update;
	private $validated == 0;





// GETTERS-----------------------------------

	public function getId_user()
	{
		return $this->id_user;
	}

	public function getId_post()
	{
		return $this->id_post;
	}

	public function getComment_content()
	{
		return $this->comment_content;
	}

	public function getComment_date()
	{
		return $this->comment_date;
	}

	public function getComment_update()
	{	
		return $this->comment_update;
	}

	public function getValidated()
	{
		return $this->validated;
	}


// SETTERS --------------------------------------

	public function setId_user($idUser)
	{
		if(is_int($idUser))
		{
			$this->id_user = $idUser;
		}
	}

	public function setId_post($idPost)
	{
		if(is_int($idPost))
		{
			$this->id_post = $idPost;
		}
	}

	public function setComment_content($content)
	{
		if(is_string($content))
		{
			$this->comment_content = $content;
		}
	}

	public function setValidated($validated)
	{
		if(is_int($validated) && (($validated == 0) || ($validated == 1)))
		{
			$this->validated = $validated;
		}
	}



}