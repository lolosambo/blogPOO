<?php
	
namespace p5\builders;
use p5\entities\Users;


class UserBuilder
{
    private $user;

    public function create()
    {
      $this->post = new Post(array $user);

      return $this;
    }

    public function setPost(Users $user)
    {
      $this->user = $user;

      return $this;
    }

    public function build()
    {
      return $this->user;
    }
}