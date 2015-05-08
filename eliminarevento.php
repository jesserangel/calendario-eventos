<?php

    require_once("class/users.php");
    require_once("libraries/inputfilter/inputfilter.php");

    $clean = new InputFilter();

    if($_SESSION["usuario_act"]){

    require_once("class/class.php");

    $_GET = $clean->process($_GET);

    $name = $_GET["tit"];

    $procesar = new ProcesarEvento();
    $procesar->deleteEventos($name);

    } else {

        header("Location: index.php");

    }
?>
