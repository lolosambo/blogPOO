<?php 

ob_start();

$title = strtoupper($post->getPost_title());


?>

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
	<div class="row post_single">

		<div class="row">

			<div class="col-lg-5 col-md-12 col-sm-12 col-12">

				<?php echo '<div class="post_single_thumbnail" style="background-image: url('.$post->getPost_img_url().');"></div>'; ?>

			</div>


			<div class="col-lg-7 col-md-12 col-sm-12 col-12">

				<div class="row">

					<div class="col-lg-12 col-md-12 col-sm-12 col-12 post_single_intro">
							
						<?php echo '<p><b><h1>'.$post->getPost_title().'</h1></b></p>'; ?>

					</div>

					<div class="col-lg-12 col-md-12 col-sm-12 col-12 post_single_info">
							
						<?php echo '<p>Ecrit par<b> '.$author->getPseudo().'</b> - Modifié le '.$post->getPostUpdate().'</p>'; ?>
									
					</div>
							

					<div class="col-lg-12 col-md-12 col-sm-12 col-12">

						  <?php echo '<h3><em><b>'.$post->getPost_heading().'</b></em></h3>'; ?>

					</div>

				</div>

			</div>

		</div>




		<div class="row">
			
			<div class="col-lg-12 col-md-12 col-sm-12 col-12 post_single_content">
					
				<?php echo '<p>'.$post->getPost_content().'</p>'; 

				echo '<p><a href="index.php"><button type="button" class=" btn btn-warning">Retour à la liste des articles</button></a></p>';

				?>

			</div>
			
		</div>
</div>

<?php

// require('../views/frontend/comments_view.php'); 

// ?>

<br>

<?php



// if ($_SESSION['verified'] == 1)
// {

// 	require('views/frontend/add_comment_view.php');

// }

// if (isset($_POST['validComment']) && ($_SESSION['id_role'] == 1))
// {

// 	echo 'Votre commentaire a bien été transmis, il sera validé dans les plus brefs délais.<br><br><br><br>';

// }

// else if (isset($_POST['validComment']) && ($_SESSION['id_role'] == 2))
// {
	
// 	echo 'Votre commentaire a bien été ajouté.<br><br><br><br>';

// }



$content = ob_get_clean();

require('../views/templates/default.php');

?>

</body>
</html>





