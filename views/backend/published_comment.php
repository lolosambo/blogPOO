<?php 

ob_start();



echo '<p>Le commentaire a bien été validé est est désormais publié.</p>';

echo '<a href="index.php?p=comments"><button type="button" class=" btn btn-warning">Retour à la liste des commentaires</button></a>';



$title = "GESTION DES COMMENTAIRES";
$content = ob_get_clean();

require('../../views/templates/admin_template.php');

?>

