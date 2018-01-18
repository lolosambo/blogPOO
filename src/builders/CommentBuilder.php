<?php
	
namespace p5\builders;
use p5\entities\Comments;


class CommentBuilder
{
    private $comment;

    public function create()
    {
      $this->comment = new Post(array $comment);

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