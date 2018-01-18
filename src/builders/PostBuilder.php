<?php
	
namespace p5\builders;
use p5\entities\Posts;


class PostBuilder
{
    private $post;

    public function create()
    {
      $this->post = new Post(array $post);

      return $this;
    }

    public function setPost(Posts $post)
    {
      $this->post = $post;

      return $this;
    }

    public function build()
    {
      return $this->post;
    }
}