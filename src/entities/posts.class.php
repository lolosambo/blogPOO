<?php

namespace blog\entities;


class Posts
{

	private $id_user;
	private $post_title;
	private $post_heading;
	private $post_content;
	private $post_date;
	private $post_update;
	private $post_img_url;

// GETTERS-----------------------------------

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

	public function getPost_update()
	{
		return $this->post_update;
	}

	public function getPost_img_url()
	{
		return $this->post_img_url;
	}


// SETTERS --------------------------------------

	public function setId_user($id)
	{
		if(is_int($id))
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

	public function set_img_url($imgUrl)
	{
		if(is_string($imgUrl))
		{
			$this->post_img_url = $imgUrl;
		}
	}



}