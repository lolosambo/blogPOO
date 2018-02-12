<?php
	
namespace P5\core\builders;
use P5\entities\Users;

class UserBuilder

{
    private $user;
    
    
    public function create(array $user)
    {
      $this->user = new Users($user);
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