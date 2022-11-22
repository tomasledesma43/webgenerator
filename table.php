<?php 

    require 'db.php';

        $result = $db->query("SELECT * FROM webs");
        echo "<table style='border:black solid 1px'>";
        while($fila=mysqli_fetch_array($result,MYSQLI_ASSOC)){
            echo '<tr><td><a href="../'.$fila["dominio"].'">'.$fila["dominio"].'</a></td></tr>';
        }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="login.php"> Cerrar Sesion </a>
</body>
</html>