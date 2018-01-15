<?php 
ob_start();



echo '<p>L\'addresse du résau social a bien été modifiée.</p>';

echo '<a href="index.php?p=networks"><button type="button" class=" btn btn-warning">Retour à la liste des réseaux</button></a>';



$title = "GESTION DES RESEAUX SOCIAUX";
$content = ob_get_clean();

require('../../views/templates/admin_template.php');

?>
