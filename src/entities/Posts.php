<?php

namespace P5\entities;
use P5\core\interfaces\hydrateInterface;

class Posts implements HydrateInterface
{

	private $postId;
	private $idUser;
	private $postTitle;
	private $postHeading;
	private $postContent;
	private $postDate;
	private $postUpdate;
	private $postImgUrl;


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

	public function getPostId()
	{
		return $this->postId;
	}

	public function getIdUser()
	{
		return $this->idUser;
	}

	public function getPostTitle()
	{
		return $this->postTitle;
	}

	public function getPostHeading()
	{
		return $this->postHeading;
	}

	public function getPostContent()
	{
		return $this->postContent;
	}

	public function getPostDate()
	{
		return $this->postDate;
	}

	public function getPostUpdate()
	{
		return $this->postUpdate;
	}

	public function getPostImgUrl()
	{
		return $this->postImgUrl;
	}


// SETTERS --------------------------------------

	public function setPostId($postId)
	{
		if(intval($postId))
		{
			$this->postId = $postId;
		}
	}


	public function setIdUser($id)
	{
		if(intval($id))
		{
			$this->idUser = $id;
		}
	}

	public function setPostTitle($title)
	{
		if(is_string($title))
		{
			$this->postTitle = $title;
		}
	}

	public function setPostHeading($heading)
	{
		if(is_string($heading))
		{
			$this->postHeading = $heading;
		}
	}

	public function setPostContent($content)
	{
		if(is_string($content))
		{
		$this->postContent = $content;
		}
	}

	public function setPostDate($date)
	{
		if(is_string($date))
		{
		$this->postDate = $date;
		}
	}

	public function setPostUpdate($date)
	{
		if(is_string($date))
		{
		$this->postUpdate = $date;
		}
	}


	public function setPostImgUrl($imgUrl)
	{
		if(is_string($imgUrl))
		{
			$this->postImgUrl = $imgUrl;
		}
	}



}

