<?php
namespace P5\controllers\backend;
use P5\core\factories\ControllerFactory;
use P5\core\interfaces\CheckImageInterface;

class AddedPostController implements CheckImageInterface
{

	private $factory;
	private $postman;
	private $session;
	private $request;
	

	public function __construct()
	{
		$factory = new ControllerFactory();
		$this->factory = $factory;
		$this->request = $this->factory->getRequest();
		$this->postman = $this->factory->getTable()->table('Posts');
		$this->session = $this->factory->getSession();
	
	}

	public function __invoke()
	{
		
		$title = $this->request->request->get('title');
		$heading = $this->request->request->get('heading');
		$post_content = $this->request->request->get('content');
		$img = $this->verifyImg();
		$user_id = $this->session->get('id');

		$this->postman->insertPost($user_id, $title, $heading, $post_content, $img);
		echo $this->factory->getTwig()->render('views/backend/added_post.twig');
	}

	public function verifyImg()
	{

		//Limit file size and location
		$folder = 'uploads/';
		$file = basename($_FILES['img']['name']);
		$size_max = 5000000;
		$size = filesize($_FILES['img']['tmp_name']);

		//Authorized file extensions in an array
		$extensions = array('.png', '.gif', '.jpg', '.jpeg');

		//Extension extraction from the file name
		$img_extension = strrchr($_FILES['img']['name'], '.'); 

		//Check the uploaded file's extension
		if(!in_array($img_extension, $extensions))
		{
   		 	$error = 'Vous devez uploader un fichier de type png, gif, jpg ou jpeg.';
   		 	echo $this->factory->getTwig()->render('views/backend/err_img.twig', ['erreur' => $error]);
   		 	die;
		}

		if($size>$size_max)
		{
   		  	$error = 'Le fichier est trop gros...';
   		  	echo $this->factory->getTwig()->render('views/backend/err_img.twig', ['erreur' => $error]);
   		  	die;
		}

		//If there's no error, begin upload
		if(!isset($error)) 
		{

    		//Formating file's name
     		$file = strtr($file, 
      	    'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
      	    'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
    		$file = preg_replace('/([^.a-z0-9]+)/i', '-', $file);

    	
    		//Move uploaded file to the final destination folder
    		if(move_uploaded_file($_FILES['img']['tmp_name'], $folder. $file))
     		{    	
      		    $site_url = "http://www.b-log-lille.fr/uploads/";
      		   	$img_url = $site_url.$file;   
     		}

     		return $img_url;

		}

	}

}
