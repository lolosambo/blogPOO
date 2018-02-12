<?php
	
namespace P5\core\builders;
use P5\entities\Comments;

class CommentBuilder

{
    private $comment;
    
    
    public function create(array $comment)
    {
      $this->comment = new Comments($comment);
      return $this;
    }
    
    
    public function setPost(Comments $comment)
    {
      $this->comment = $comment;
      return $this;
    }
    
    
    public function build()
    {
      return $this->comment;
    }
    
    
}

