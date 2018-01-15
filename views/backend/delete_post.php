
<?php 
ob_start();




echo '<p>L\'article a bien été supprimé</p>';

echo '<a href="index.php?p=posts"><button type="button" class=" btn btn-warning">Retour à la liste des articles</button></a>';


$title = "ARTICLE SUPPRIME";
$content = ob_get_clean();

require('../../views/templates/admin_template.php');

?>
