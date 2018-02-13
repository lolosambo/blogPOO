<?php
namespace P5\entities;
use P5\core\interfaces\hydrateInterface;


class Comments implements HydrateInterface

{
	private $commentId;
	private $idUser;
	private $idPost;
	private $commentContent;
	private $commentDate;
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

	public function getIdUser()
	{
		return $this->idUser;
	}

	public function getIdPost()
	{
		return $this->idPost;
	}

	public function getCommentContent()
	{
		return $this->commentContent;
	}

	public function getCommentDate()
	{
		return $this->commentDate;
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

	public function setIdUser($idUser)
	{
		if(intval($idUser))
		{
			$this->idUser = $idUser;
		}
	}

	public function setIdPost($idPost)
	{
		if(intval($idPost))
		{
			$this->idPost = $idPost;
		}
	}

	public function setCommentUpdate($date)
	{
		if(is_string($date))
		{
			$this->commentUpdate = $date;
		}
	}

	public function setCommentContent($content)
	{
		if(is_string($content))
		{
			$this->commentContent = $content;
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

