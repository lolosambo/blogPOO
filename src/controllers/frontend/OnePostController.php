<?php
namespace P5\controllers\frontend;

use P5\core\factories\ControllerFactory;

class OnePostController {

	private $postman;
	private $factory;
	private $session;
	private $request;
	

	public function __construct() {
		$factory = new ControllerFactory();
		$this->factory = $factory;
		$manager = $factory->getTable()->table('Posts');
		$this->postman = $manager;
		$this->session = $factory->getSession();
		$this->request = $factory->getRequest();
	}

	public function __invoke() {
		// turn "_" into " " to find the same title as the postTitle value 
		$url = urldecode($this->request->server->get('REQUEST_URI'));
		preg_match('#([^/]+)$#', $url, $match);
		$title = str_replace('_', ' ', $match[1]);
		// get the post with postTitle in parameter
		$res = $this->postman->onePost($title);
		// Post & Author objects hydrated with request data
		$post = $this->factory->getBuilder()->builder('post')->create($res)->build();
		$author = $this->factory->getBuilder()->builder('user')->create($res)->build();
		// Back up PostId, id_role, userId and commentContent for transmission
		$postId = $post->getPostId();
		$id_role = $this->session->get('id_role');
		$userId = $this->session->get('id');
		$commentContent = $this->request->request->get('comment');
		$commentValidation = $this->request->request->get('validComment');

		// if the comment form was completed, insertion into the database
		if (isset($commentValidation)) {
			$this->factory->getFrontController('AddCommentController')->addComment($postId, $id_role, $userId, $commentContent);
		}
		// Show all comments frome the post
		$comments = $this->factory->getFrontController('AllCommentsController')->allComments($postId);
		$sidebar = $this->factory->getFrontController('loginController');
		$networks = $this->factory->getFrontController('SocialNetworksController');
		// Render twig
		echo $this->factory->getTwig()->render('views/frontend/post_view.twig', [
			'post' => $post, 
			'author' => $author,
			'sidebar' => $sidebar,
			'network' => $networks,
			'comments' => $comments,
			'role' =>$id_role,
			'validation' =>$commentValidation,
			'title' => $match[1],
			
		]);
	}
}

