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

echo 'Le chargement de votre image n\'a pu aboutir : vérifiez que votre image ne dépasse pas 5mo et qu\'elle soit bien aux formats .jpeg, .jpg, .gif ou .png';



$title = "ERREUR CHARGEMENT IMAGE";
$content = ob_get_clean();

require('../../views/backend/admin_template.php');

?>

</body>
</html>