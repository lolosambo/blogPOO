<?php 
ob_start();


echo 'Le chargement de votre image n\'a pu aboutir : vérifiez que votre image ne dépasse pas 5mo et qu\'elle soit bien aux formats .jpeg, .jpg, .gif ou .png';


$title = "ERREUR CHARGEMENT IMAGE";
$content = ob_get_clean();

require('../../views/templates/admin_template.php');

?>
