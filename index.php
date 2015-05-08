<?php

    error_reporting(E_ALL ^ E_NOTICE);

    require_once("class/users.php");

    if($_SESSION["usuario_act"]){

        header("Location: home.php");

    } else {

?>
<!DOCTYPE html>
<html lang="es-VE">
<head>
    <title>Calendario de Eventos</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" href="css/estilos.css" />
    <script src="libraries/modernizr/modernizr.js"></script>
</head>
<body>
    <div id="contenedor">
        <?php include("includes/header.php"); ?>
        <article>
            <?php if($_GET and $_GET["error"] == 1){ echo "<h3 align='center' style='margin-bottom: 1em;'>Error: <span style='color: red;'>Debe rellenar todos los campos, por favor intente de nuevo.</span></h3>";}?>
            <?php if($_GET and $_GET["error"] == 2){ echo "<h3 align='center' style='margin-bottom: 1em;'>Error: <span style='color: red;'>Usuario o contrase&ntilde;a incorrecto, por favor verifique e intente de nuevo.</span></h3>";}?>
            <?php if($_GET and $_GET["msg"] == 1){ echo "<h3 align='center' style='margin-bottom: 1em;'>Aviso: <span style='color: green;'>Usuario creado con exito, por favor ingrese su nombre de usuario y contrase&ntilde;a.</span></h3>";}?>
        </article>
        <article class="float-left">
            <form name="frm_ingreso" action="gestionusuarios.php" method="POST" onload="document.form.reset();document.form.txt_login.focus();">
            <table>
                <br />
                <tr>
                    <div><td align="right"><label>Nombre de Usuario: </label></td>
                    <td><input type="text" name="txt_login" /></td></div>
                </tr>
                <tr>
                    <td align="right"><label>Contrase&ntilde;a: </label></td>
                    <td><input type="password" name="pwd_pass" /></td>
                </tr>
                <tr>
                    <td align="center"><input type="submit" name="btn_ingresar" value="Ingresar" class="format-button-search"/></td>
                    <td align="center"><a class="format-a" href="registrousuario.php">Registrarse</a></td>
                </tr>
            </table>
            </form>
            <a href="https://github.com/jesse315/calendario_eventos" target="_blank" class="github-button"><img src="img/github.png" alt="Fork me on Github" ></a>
        </article>
        <article class="float-right twitter-widget">
            <a class="twitter-timeline"  href="https://twitter.com/Jesse_Rangel"  data-widget-id="385135742801805312" data-theme="dark" data-chrome="nofooter noscrollbar">Tweets por @Jesse_Rangel</a>
            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
        </article>
    </div>
</body>
</html>
<?php
     }
?>