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


echo '<p>Le commentaire a bien été validé est est désormais publié.</p>';

echo '<a href="http://www.b-log-lille.fr/p5/public/admin/index.php?p=comments"><button type="button" class=" btn btn-warning">Retour à la liste des commentaires</button></a>';



$title = "GESTION DES COMMENTAIRES";
$content = ob_get_clean();

require('../../views/backend/admin_template.php');

?>

</body>
</html>