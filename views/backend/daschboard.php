<?php 
use p5\entities\Posts;
use p5\entities\Users;
use p5\entities\Comments;


?>

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

foreach ($users as $data)
{
	$post = new Posts($data);
	$author = new Users($data);
		
	
	echo '<p><b>'.$author->getPseudo().'</b> - Inscrit(e) le : '.$author->getInscr_date().'</p>';
}

$users = ob_get_clean();



ob_start(); ?>

<h6>Les 3 derniers articles</h6>

<?php 

foreach ($posts as $data)
{
	$post = new Posts($data);

	echo '<p><em>Dernière mise à jour le :'.$post->getPostUpdate().'</em><br>';
	echo '<b>'.$post->getPost_title().'</b><br></p>';
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


<?php require('../../views/templates/daschboard_template.php'); ?>


</body>
</html>