<?php

    require_once("class/users.php");
    require_once("libraries/inputfilter/inputfilter.php");

    $clean = new InputFilter();

    $_POST = $clean->process($_POST);

    if(isset($_POST["btn_ingresar"])){

        $procesarUsuario = new Usuarios();
        $procesarUsuario->ingresoUsuario();

    } else if(isset($_POST["btn_registrar"])){

        $registrarUsuario = new Usuarios();
        $registrarUsuario->addUsuarios($_POST["txt_nombre"], $_POST["txt_apellido"], $_POST["txt_login"], $_POST["pwd_pass"]);
    }

?>