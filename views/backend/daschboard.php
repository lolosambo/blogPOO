


<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>ADMINISTRATION DU BLOG</title>
		<link rel="stylesheet" href="../../public/bootstrap/dist/css/bootstrap.min.css" type="text/css"/>
		<link rel="stylesheet" href="../../public/css/admin_style.css" type="text/css"/>	
	</head>
	
<body>




<?php ob_start(); ?>

<h6>Les 5 utilisateurs enregistrés</h6>

<?php

while($data = $users->fetch())
{
	echo '<p><b>'.$data['pseudo'].'</b> - Inscrit(e) le : '.$data['inscrDate'].'</p>';
}

$users = ob_get_clean();



ob_start(); ?>

<h6>Les 3 derniers articles</h6>

<?php 

while($data = $posts->fetch())
{
	echo '<p><em>Dernière mise à jour le :'.$data['postUpdate'].'</em><br>';
	echo '<b>'.$data['post_title'].'</b><br></p>';
}

$posts = ob_get_clean();





ob_start(); ?>

<h6>Les 3 derniers commentaires validés</h6>

<?php 

while($data = $comments1->fetch())
{
	echo '<p><em>Posté le : '.$data['commentUpdate'].'</em><br>';
	echo '<b>'.$data['post_title'].'</b><br>';
	echo $data['comment_content'].'<br>';
	echo '---------------------------------------</p>';
}

$validComments = ob_get_clean();





ob_start(); ?>

<h6>Les 3 derniers commentaires à valider</h6>

<?php 

while($data = $comments0->fetch())
{
	echo '<p><em>Posté le : '.$data['commentUpdate'].'</em><br>';
	echo '<b>'.$data['post_title'].'</b><br>';
	echo $data['comment_content'].'<br>';
	echo '---------------------------------------</p>';
}

$comments = ob_get_clean();

?>


<?php require('../../views/backend/daschboard_template.php'); ?>


</body>
</html>