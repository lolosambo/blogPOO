<?php 

use p5\entities\Posts;
use p5\entities\Users;
use p5\controllers\frontend\PostsController;
use p5\controllers\frontend\PaginationController;

$title = 'ACCUEIL BLOG';

ob_start(); ?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title><?php echo $title; ?></title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" type="text/css"/>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" type="text/css"/>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.bundle.min.js" type="text/css"/>
		<link rel="stylesheet" href="css/style.css" type="text/css"/>
		<link href="https://fonts.googleapis.com/css?family=Muli|Nunito|Nunito+Sans|Oswald" rel="stylesheet"> 	
	</head>
	
<body>

<?php

foreach ($res as $posts)
		{
			$post = new Posts($posts);
			$author = new Users($posts);
		
?>


<div class="row">		
		
		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

			<div class="row post">

				<div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">

					<div class="row">

						<div class="col-md-12 col-sm-12  thumbnail" style="background-image: url(<?php echo $post->getPost_img_url(); ?>);"></div>

					</div>

					<div class="row">

		  				<div class="col-md-12 col-sm-12  post_info">
		  	
		  					<?php echo '<p>Ecrit par<b> '.$author->getPseudo().'</b><br>Modifé le '.$post->getPostUpdate().'</p>'; ?>
		  			
		  				</div>

		  			</div>

		  		</div>

				<div class="col-lg-7 col-md-11 col-sm-11  post_content">

				<?php

					echo '<p><b><h1>'.$post->getPost_title().'</h1></b></p>';
		
					echo '<p>'.substr($post->getPost_heading(), 0, 200).'</p>';

					?>
						
					<a href="index.php?action=singlePost&amp;id=<?php echo $post->getPostId();?>">

						<button type="button" class="btn btn-warning">Lire la suite</button>

					</a><br>

				</div>

			</div>

		</div>
		
<?php

} 

?>

</div>
<?php



echo '<p style="text-align : center;">Page : ';

$pagincont->showPagination();

echo '</p>';

$content = ob_get_clean();

require('../views/templates/default.php');

?>

	

	

	
		
