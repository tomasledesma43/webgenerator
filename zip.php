<?php

    session_start();
    if(!isset($_SESSION['idUsuario'])){
        header("location:login.php");
    }

    if(isset($_GET['dominio'])){
        $d=$_GET['dominio'];
        shell_exec("zip ../".$d.".zip"." ../".$d);
        header("location:../".$d.".zip");
    }


?>