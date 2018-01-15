<?php
namespace p5\entities;
use p5\interfaces\hydrateInterface;


class Comments implements HydrateInterface

{
	private $commentId;
	private $id_user;
	private $id_post;
	private $comment_content;
	private $comment_date;
	private $commentUpdate;
	private $validated = 0;


// INTERFACE METHOD

public function hydrate(array $donnees)
{
   foreach ($donnees as $key => $value)
   {
       $method = 'set'.ucfirst($key);

       if (method_exists($this, $method))
       {
         $this->$method($value);
       }
   }
}


// CONSTRUCTOR & HYDRATATION

	public function __construct(array $data)
	{

		$this->hydrate($data);

	}


// GETTERS-----------------------------------

	public function getCommentId()
	{
		return $this->commentId;
	}

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

	public function getCommentUpdate()
	{	
		return $this->commentUpdate;
	}

	public function getValidated()
	{
		return $this->validated;
	}


// SETTERS --------------------------------------


	public function setCommentId($commentId)
	{
		if(intval($commentId))
		{
			$this->commentId = $commentId;
		}
	}

	public function setId_user($idUser)
	{
		if(intval($idUser))
		{
			$this->id_user = $idUser;
		}
	}

	public function setId_post($idPost)
	{
		if(intval($idPost))
		{
			$this->id_post = $idPost;
		}
	}

	public function setCommentUpdate($date)
	{
		if(is_string($date))
		{
			$this->commentUpdate = $date;
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
		if(intval($validated) && (($validated == 0) || ($validated == 1)))
		{
			$this->validated = $validated;
		}
	}



}