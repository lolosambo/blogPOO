<?php
namespace P5\controllers\frontend;

use P5\core\factories\ControllerFactory;

class AllCommentsController {

	private $commentman;

	public function __construct() {
		$factory = new ControllerFactory();
		$this->commentman = $factory->getTable()->Table('comments');
	}

	public function allComments($postId) {
		$res = $this->commentman->getComments($postId);
		return $res;
	
	}


}

