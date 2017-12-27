
<?php 
session_cache_limiter('private_no_expire, must-revalidate');
session_start();  


ob_start();

?>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="../../public/css/menu.css" type="text/css">
</head>

<body>


<?php




while ($res=$posts->fetch())
{
	
	echo '<p><b>'.strtoupper($res['post_title']).'</b></p>';
	echo '<p><em>Dernière mise à jour le '.$res['postUpdate'].'</em> - Edité par : <b>'.$res['pseudo'].'</b></p>';
	echo '<a href="http://www.b-log-lille.fr/p5/public/admin/index.php?p=updatePost&postId='.$res['postId'].'"><button type="button" class=" btn btn-dark">Modifier l\'article</button>  </a>';
	echo '<a href="http://www.b-log-lille.fr/p5/public/admin/index.php?p=deletePost&postId='.$res['postId'].'"><button type="button" class=" btn btn-dark">Supprimer l\'article</button> </a></p>';
	echo '--------------------------------------------------';
					
}

$posts->closeCursor();

// SHOWS PAGINATION
echo '<p style="text-align : center;">Page : ';

for($i=1; $i<=$pagesNbr; $i++)
{
    
     if($i==$currentPage)
    {
     	echo ' [ '.$i.' ] '; 
    }	
    
    else
     {
     	echo ' <a href="http://www.b-log-lille.fr/p5/public/admin/index.php?p=posts&amp;page='.$i.'">'.$i.'</a> ';
     }
}

echo '</p><br><br>';


echo '<br><br><a href="http://www.b-log-lille.fr/p5/public/admin/index.php?p=addPostForm"><button type="button" class=" btn btn-warning">Nouvel article</button></a><br><br><br>';


$title = "GESTION DES ARTICLES";
$content = ob_get_clean();

require('../../views/backend/admin_template.php');

?>

</body>
</html>