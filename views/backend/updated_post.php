
<?php 
ob_start();


echo '<p>Votre article a bien été modifié</p>';

echo '<a href="index.php?p=posts"><button type="button" class=" btn btn-warning">Retour à la liste des articles</button></a>';



$title = "MODIFIER UN ARTICLE";
$content = ob_get_clean();

require('../../views/templates/admin_template.php');

?>

</body>
</html>