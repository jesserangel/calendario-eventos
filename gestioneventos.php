<?php

    require_once("class/users.php");

    if($_SESSION["usuario_act"]){

    require_once("class/class.php");
    require_once("libraries/resize/resize.php");
    require_once("libraries/inputfilter/inputfilter.php");

    error_reporting(E_ALL ^ E_NOTICE);

    $clean = new InputFilter();

    $_POST = $clean->process($_POST);

    if(isset($_POST["btn_submit"])){

        $procesar = new ProcesarEvento();

        if(!empty($_FILES['fle_foto']['name'])){

            copy($_FILES["fle_foto"]["tmp_name"],"img/".$_FILES["fle_foto"]["name"]);

            $thumb = new thumbnail("img/".$_FILES["fle_foto"]["name"]);
            $thumb->size_width(200);				// set width for thumbnail, or
            $thumb->size_height(200);				// set height for thumbnail, or
            $thumb->jpeg_quality(75);				// [OPTIONAL] set quality for jpeg only (0 - 100) (worst - best), default = 75
            $foto = $_FILES["fle_foto"]["name"];
            $thumb->save("img/".$foto.".jpg");

            unlink("img/".$_FILES["fle_foto"]["name"]);

        }  else {

            $foto = "no-image";

        }

        $procesar->addEventos($_POST["txt_titulo"], $_POST["txa_descripcion"], $_POST["txt_inicio"], $foto, $_POST["txt_fin"], $_SESSION["usuario_id"]);

    } else if(isset($_POST["btn_actualizar"])) {

        $procesar = new ProcesarEvento();

        if(!empty($_FILES['fle_foto']['name'])){

            copy($_FILES["fle_foto"]["tmp_name"],"img/".$_FILES["fle_foto"]["name"]);

            $thumb = new thumbnail("img/".$_FILES["fle_foto"]["name"]);
            $thumb->size_width(200);				// set width for thumbnail, or
            $thumb->size_height(200);				// set height for thumbnail, or
            $thumb->jpeg_quality(75);				// [OPTIONAL] set quality for jpeg only (0 - 100) (worst - best), default = 75
            $foto = $_FILES["fle_foto"]["name"];
            $thumb->save("img/".$foto.".jpg");

            unlink("img/".$_FILES["fle_foto"]["name"]);

        }  else {

            $foto = "no-image";

        }

        $procesar->updateEventos($_POST["id"], $_POST["txt_titulo"], $_POST["txa_descripcion"], $_POST["txt_inicio"], $foto, $_POST["txt_fin"]);

    } else {

    }
?>
<!DOCTYPE html>
<html lang="es-VE">
<head>
    <meta http-equiv="refresh" content="0;url=index.php" />
</head>
</html>
<?php
    } else {

        header("Location: index.php");

    }
?>