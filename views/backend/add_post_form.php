
<?php 
ob_start();

?>

<form method="POST" action="index.php?p=addPost" enctype="multipart/form-data" name="add_post">

	<label for="title">Titre : </label>
	<input type="text" name="title" lenght=230></input><br>

	<label for="heading">Chapô : </label>
	<textarea name="heading" cols=60 rows=5></textarea><br>

	<label for="content">Contenu : </label>
	<textarea name="content" cols=60 rows=10></textarea><br><br>

	<!-- Image insertion field -->
	<input type="hidden" name="MAX_FILE_SIZE" value="5000000" />
 	<label for="img">Insérer une image : </label>
 	<input name="img" type="file"/><br><br>
  
	<button type="submit" class="btn btn-warning" name="publier">Publier</button><br>

</form>

<?php


echo '<a href="index.php?p=posts"><button type="button" class=" btn btn-warning">Retour à la liste des articles</button></a>';


$title = "ECRIRE UN ARTICLE";
$content = ob_get_clean();

require('../../views/templates/admin_template.php');

?>

