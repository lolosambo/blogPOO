<?php 
session_cache_limiter('private_no_expire, must-revalidate');
session_start(); 

ob_start();

	
$post_data = $post->fetch();

$title = strtoupper($post_data['post_title']);

?>
	<div class="row post_single">

		<div class="row">

			<div class="col-lg-5 col-md-12 col-sm-12 col-12">

				<?php echo '<div class="post_single_thumbnail" style="background-image: url('.$post_data['post_img_url'].');"></div>'; ?>

			</div>


			<div class="col-lg-7 col-md-12 col-sm-12 col-12">

				<div class="row">

					<div class="col-lg-12 col-md-12 col-sm-12 col-12 post_single_intro">
							
						<?php echo '<p><b><h1>'.$post_data['post_title'].'</h1></b></p>'; ?>

					</div>

					<div class="col-lg-12 col-md-12 col-sm-12 col-12 post_single_info">
							
						<?php echo '<p>Ecrit par<b> '.$post_data['pseudo'].'</b> - Modifié le '.$post_data['postUpdate'].'</p>'; ?>
									
					</div>
							

					<div class="col-lg-12 col-md-12 col-sm-12 col-12">

						  <?php echo '<h3><em><b>'.$post_data['post_heading'].'</b></em></h3>'; ?>

					</div>

				</div>

			</div>

		</div>




		<div class="row">
			
			<div class="col-lg-12 col-md-12 col-sm-12 col-12 post_single_content">
					
				<?php echo '<p>'.$post_data['post_content'].'</p>'; 

				echo '<p><a href="http://www.b-log-lille.fr/p5/index.php"><button type="button" class=" btn btn-warning">Retour à la liste des articles</button></a></p>';

				?>

			</div>
			
		</div>
</div>

<?php

require('views/frontend/comments_view.php'); 

?>

<br>

<?php



if ($_SESSION['verified'] == 1)
{

	require('views/frontend/add_comment_view.php');

}

if (isset($_POST['validComment']) && ($_SESSION['id_role'] == 1))
{

	echo 'Votre commentaire a bien été transmis, il sera validé dans les plus brefs délais.<br><br><br><br>';

}

else if (isset($_POST['validComment']) && ($_SESSION['id_role'] == 2))
{
	
	echo 'Votre commentaire a bien été ajouté.<br><br><br><br>';

}



$content = ob_get_clean();

require('views/frontend/template.php');

?>





