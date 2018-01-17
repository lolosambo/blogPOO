<?php
namespace p5\controllers\backend;

class AdminImagesController
{
	
	public function verifyImg()
	{

		//Limit file size and location
		$folder = '../uploads/';
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
		}

		if($size>$size_max)
		{
   		  	$error = 'Le fichier est trop gros...';
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
      		    $site_url = "http://www.b-log-lille.fr/public/uploads/";
      		   	$img_url = $site_url.$file;   
     		}

     		return $img_url;

		}

	}

	public function img_message()
	{
		require('../../views/backend/err_post.php');
	}

}