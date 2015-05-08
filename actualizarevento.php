<?php

    require_once("class/users.php");
    require_once("libraries/inputfilter/inputfilter.php");

    $clean = new InputFilter();

    if($_SESSION["usuario_act"]){

    require_once("class/class.php");

    $_GET = $clean->process($_GET);

    $name = $_GET["tit"];

    $procesar = new ProcesarEvento();
    $listar_eventos_name = $procesar->getEventosByName($name);
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
            <ul>
                <?php
                    for($i=0; $i<sizeof($listar_eventos_name); $i++){
                    $palabra = ProcesarEvento::replaceGuiones($listar_eventos_name[$i]["titulo_evento"]);
                ?>
                <form name="frm-regevent" action="gestioneventos.php" method="POST" enctype="multipart/form-data">
                <table>
                    <br /><br />
                    <tr>
                        <label>Titulo del evento: </label>
                        <input type="text" name="txt_titulo" value="<?php echo $palabra;?>" />
                    </tr>
                    <br /><br />
                    <tr>
                        <label>Inicio del evento: </label>
                        <input type="text" name="txt_inicio" value="<?php echo $listar_eventos_name[$i]['inicio_evento']?>" />
                    </tr>
                    <br /><br />
                    <tr>
                        <label>Culminaci&oacute;n del evento: </label>
                        <input type="text" name="txt_fin" value="<?php echo $listar_eventos_name[$i]['fin_evento']?>" />
                    </tr>
                    <br /><br />
                    <tr>
                        <label>Foto de evento (opcional): </label>
                        <input type="file" name="fle_foto" />
                    </tr>
                    <br /><br />
                    <tr>
                        <label>Descripci&oacute;n del evento: </label><br /><br />
                        <textarea name="txa_descripcion" rows="10" cols="50"><?php echo $listar_eventos_name[$i]['descripcion_evento']?></textarea>
                    </tr>
                    <br /><br />
                    <tr>
                        <input type="hidden" name="id" value="<?php echo $listar_eventos_name[$i]['id_evento'] ?>" />
                        <div align="center"><input type="submit" name="btn_actualizar" class="format-button" value="Actualizar evento" />
                        <button class="format-button" onclick="window.location='home.php'">Volver</button></div>
                    </tr>
                </table>
                </form>
                <?php } ?>
            </ul>
        </article>
        <?php include("includes/footer.php"); ?>
    </div>
</body>
</html>
<?php
    } else {

        header("Location: index.php");

    }
?>