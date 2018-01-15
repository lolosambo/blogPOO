
<?php 

ob_start();

?>

	<form method="POST" action="index.php?p=postUpdated&amp;postId=<?php echo $post->getPostId(); ?>" enctype="multipart/form-data" name="update_post">

		<label for="title">Titre : </label>
		<input type="text" name="title" lenght=400 value="<?php echo $post->getPost_title();?>"></input><br><br>

		<label for="heading">Chapô : </label>
		<textarea name="heading" cols=130 rows=10><?php echo $post->getPost_heading();?></textarea><br><br>

		<label for="content">Contenu : </label>
		<textarea name="content" cols=130 rows=20><?php echo $post->getPost_content();?></textarea><br><br>
  
		<button type="submit" class="btn btn-warning btn-sm" name="publier">Publier</button><br><br>

	</form>

<?php


$title = "MODIFIER UN ARTICLE";
$content = ob_get_clean();

require('../../views/templates/admin_template.php');

?>

