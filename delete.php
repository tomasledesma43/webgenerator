<?php

    require 'db.php';

    if(isset($_GET['dominio'])){
        $d=$_GET['dominio'];
        $result = $db -> query("DELETE FROM `webs` WHERE dominio ='".$d."'");
        shell_exec("rm -r ../".$d);
        header("location:panel.php");
    }

?>