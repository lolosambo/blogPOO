<?php
namespace P5\core\builders;

use P5\entities\Posts;

class PostBuilder {
    private $post;
    
    public function create(array $post) {
      $this->post = new Posts($post);
      return $this;
    }
     
    public function setPost(Posts $post) {
      $this->post = $post;
      return $this;
    }
     
    public function build() {
      return $this->post;
    }
}

