<?php

    require_once("class/users.php");

    if($_SESSION["usuario_act"]){

        session_destroy();

        header("Location: index.php");

    } else {

        header("Location: index.php"); 

    }
?>