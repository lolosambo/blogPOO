<?php

namespace p5\entities;
use p5\interfaces\hydrateInterface;

class Posts implements HydrateInterface
{

	private $postId;
	private $id_user;
	private $post_title;
	private $post_heading;
	private $post_content;
	private $post_date;
	private $postUpdate;
	private $post_img_url;


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

	public function getId_user()
	{
		return $this->id_user;
	}

	public function getPost_title()
	{
		return $this->post_title;
	}

	public function getPost_heading()
	{
		return $this->post_heading;
	}

	public function getPost_content()
	{
		return $this->post_content;
	}

	public function getPost_date()
	{
		return $this->post_date;
	}

	public function getPostUpdate()
	{
		return $this->postUpdate;
	}

	public function getPost_img_url()
	{
		return $this->post_img_url;
	}


// SETTERS --------------------------------------

	public function setPostId($postId)
	{
		if(intval($postId))
		{
			$this->postId = $postId;
		}
	}


	public function setId_user($id)
	{
		if(intval($id))
		{
			$this->id_user = $id;
		}
	}

	public function setPost_title($title)
	{
		if(is_string($title))
		{
			$this->post_title = $title;
		}
	}

	public function setPost_heading($heading)
	{
		if(is_string($heading))
		{
			$this->post_heading = $heading;
		}
	}

	public function setPost_content($content)
	{
		if(is_string($content))
		{
		$this->post_content = $content;
		}
	}

	public function setPost_date($date)
	{
		if(is_string($date))
		{
		$this->post_date = $date;
		}
	}

	public function setPostUpdate($date)
	{
		if(is_string($date))
		{
		$this->postUpdate = $date;
		}
	}


	public function setPost_img_url($imgUrl)
	{
		if(is_string($imgUrl))
		{
			$this->post_img_url = $imgUrl;
		}
	}



}