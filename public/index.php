<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" type="text/css"/>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" type="text/css"/>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.bundle.min.js" type="text/css"/>
	<link rel="stylesheet" href="css/style.css" type="text/css"/>

</head>
<body>

<?php

require '../vendor/autoload.php';


$db= new blog\database\Database();

$req = $db->query('SELECT * FROM Users');

while($data = $req->fetch(PDO::FETCH_OBJ))
{

echo $data->pseudo.'<br>';

}




 

?>
</body>
</html>