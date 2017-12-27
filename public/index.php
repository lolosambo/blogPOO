<!DOCTYPE html>
<html>
<head>



</head>
<body>



<?php

require('../vendor/autoload.php');

$db= new src\database\Database();

$req = $db->query('SELECT * FROM Users');

$data = $req->fetch();

echo $data['pseudo'].'<br>';






 

?>
</body>
</html>