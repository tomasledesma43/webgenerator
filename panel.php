<?php 

    require 'db.php';

    session_start();

    if(isset($_GET['mode'])){
        header("location:table.php");
    }
    
    if(!isset($_SESSION['idUsuario'])){
        header("location:login.php");
    }
    $idUsuario=$_SESSION['idUsuario'];
    if(isset($_GET['boton'])){
        $web=$_GET['web'];
        $web=$idUsuario.$web;
        $result = $db->query("SELECT * FROM webs WHERE dominio='".$web."'");
        $res = mysqli_fetch_array($result,MYSQLI_ASSOC);
        if(! $result->num_rows){
            $date=date("Y-m-d");
            $result = $db->query('INSERT INTO `webs` (`idWeb`, `idUsuario`, `dominio`, `fechaCreacion`) VALUES (NULL, "'.$idUsuario.'", "'.$web.'", "'.$date.'")');
            if($result){
                echo "web generada correctamente";
                shell_exec("../wix.sh ../".$web);
            } else{
                echo "Ocurrio un error";
            }
        }else{
            echo "Ya existe una web con ese nombre";
        }
    }

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido a tu panel</title>
    <style>
        body > form {
            display:flex;
            margin-top:10vh;
            flex-direction:column;
            align-items:center;
            justify-content:space-between;
            gap:20px;
        }
        body {
            display:flex;
            flex-direction:column;
            align-items:center;
        }
    </style>
</head>
<body>
    <a href="logout.php"><?php echo "Cerrar Sesion ".$idUsuario?></a><br>
    <form action="">
        <h2>Generar web de:</h2>
        <input type="text" name="web" id="" placeholder="Nombre de la pagina web" required>
        <input type="submit" value="Crear Web" name="boton">
    </form>
    <?php
        $result = $db->query("SELECT * FROM webs WHERE idUsuario='".$idUsuario."'");
        echo "<table style='border:black solid 1px'>";
        while($fila=mysqli_fetch_array($result,MYSQLI_ASSOC)){
            echo '<tr><td><a href="../'.$fila["dominio"].'">'.$fila["dominio"].'</a></td><td><a href="zip.php?dominio='.$fila["dominio"].'">Descargar web</a></td><td><a href="delete.php?dominio='.$fila["dominio"].'">Eliminar</a></td></tr>';
        }
    ?>
</body>
</html>