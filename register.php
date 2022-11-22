<?php 

    require 'db.php';

    if(isset($_GET['boton'])){
        $pos=strrpos($_GET['email'],'@');
        $pos2=strrpos($_GET['email'],'.com');
        if($pos === false || $pos2 === false || $pos > $pos2){
            echo "mail ingresado erroneamente";
        } else {
            $email = $_GET['email'];
            $c1 = $_GET['c1'];
            $c2 = $_GET['c2'];
            //var_dump($db);
            $result = $db->query("SELECT email FROM usuarios WHERE email='".$email."'");
            //var_dump($result);
            if (! $result->num_rows) {
                if($c1!=$c2){
                    echo "Las contraseñas no coinciden";
                }else{
                    $date=date("Y-m-d");
                    $result = $db->query('INSERT INTO `usuarios` (`idUsuario`, `email`, `password`, `fechaRegistro`) VALUES (NULL, "'.$email.'" , "'.$c1.'", "'.$date.'")');
                    if($result){
                        echo "User creado correctamente";
                        header("location:login.php");
                    } else{
                        echo "Ocurrio un error";
                    }
                }
            }else{
                echo "Ya existe un user con ese email";
            }
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarte es simple</title>
    <style>
        form {
            display:flex;
            margin-top:20vh;
            flex-direction:column;
            align-items:center;
            justify-content:space-between;
            gap:20px;
        }
    </style>
</head>
<body>

    <form action="">
        <h1>Registrarte es simple</h1>
        <input type="text" name="email" id="" placeholder="email" required>
        <input type="password" name="c1" id="" placeholder="contraseña" required>
        <input type="password" name="c2" id="" placeholder="repetir contraseña" required>
        <input type="submit" value="Registrarse" name="boton">
    </form>
</body>
</html>