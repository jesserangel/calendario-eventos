<?php

    require_once("class/users.php");
    require_once("libraries/inputfilter/inputfilter.php");

    $clean = new InputFilter();

    $_GET = $clean->process($_GET);

    $_POST = $clean->process($_POST);  

    if($_SESSION["usuario_act"]){

    require_once("class/class.php");

    if(isset($_POST["btn_buscar"])) {

        $procesar = new ProcesarEvento();
        $listar_eventos = $procesar->searchEventos($_POST["txt_buscar"]);

        $total_eventos = 0;
        $num_eventos = 0;
        $mod_eventos = 0;
        $ultimo_evento = 0;

    } else {

        $procesar = new ProcesarEvento();

        if(isset($_GET["pos"])){
            $inicio = $_GET["pos"];
        } else {
            $inicio = 0;
        }

        $listar_eventos = $procesar->getEventos($_SESSION["usuario_id"], $inicio);
        $total_eventos = $procesar->getCountEventos($_SESSION["usuario_id"]);
        $num_eventos = $total_eventos / 10;
        $mod_eventos = $total_eventos % 10;
        $ultimo_evento = $total_eventos - $mod_eventos;

    }

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
            <div align="center" style="display: inline-block; width: 30%;"><?php echo "<h3 align='center' style='margin-bottom: 1em;'>Bienvenido(a): <span style='color: green;'>". $_SESSION["usuario_act"] ."</span></h3>";?>
            <button class="format-button-search margin-class-1" onclick="window.location='salir.php'">Cerrar sesi&oacute;n</button></div>
        </article>
        <article>
            <form name="frm_search" action="#" method="POST">
            <div align="center">
            <table>
            <tr>
                <td>Buscar Evento(s): </td>
                <td><input type="text" name="txt_buscar" /></td>
                <td><input type="submit" name="btn_buscar" value="Buscar" class="format-button-search"/></td>
            </tr>
            </table>
            </div>
            </form>
        </article><br />
        <article>
            <ul>
                <?php
                    for($i=0; $i<sizeof($listar_eventos); $i++){
                        $i+1;
                    }
                    if(isset($_POST["btn_buscar"])) {
                        echo "<div align='center'><p>Coincidencias encontradas: ". $i ."</p></div><br /><br /><br />";
                    }
                ?>
                <?php
                    for($i=0; $i<sizeof($listar_eventos); $i++){
                    $palabra = ProcesarEvento::replaceGuiones($listar_eventos[$i]["titulo_evento"]);
                ?>
                <li>
                    <img class="format-img" src="img/<?php echo $listar_eventos[$i]["foto_evento"];?>.jpg" alt="<?php echo $listar_eventos[$i]["foto_evento"] ?>" /><br />
                    <p class="format-p"><span class="format-span">Titulo del evento:</span> <?php echo $palabra ?></p><br />
                    <p class="format-p"><span class="format-span">Inicio del evento:</span> <?php echo $listar_eventos[$i]["inicio_evento"] ?></p><br />
                    <p class="format-p"><span class="format-span">Finalizaci&oacute;n del evento:</span> <?php echo $listar_eventos[$i]["fin_evento"] ?></p><br />
                    <p class="format-p"><span class="format-span">Descripci&oacute;n:</span> <?php echo $listar_eventos[$i]["descripcion_evento"] ?></p><br />
                    <p class="format-p"><span class="format-span">Fecha de creaci&oacute;n:</span> <?php echo $listar_eventos[$i]["fecha_evento"] ?></p><br />
                </li>
                <div style"clear: both;"></div>
                <br /><br />
                <div align="center"><a class="format-a" href="actualizarevento.php?tit=<?php echo $listar_eventos[$i]["titulo_evento"] ?>">Actualizar Evento</a>
                <a class="format-a" onclick="return confirm('&#191;Realmente deseas eliminar este evento?');" href="eliminarevento.php?tit=<?php echo $listar_eventos[$i]["titulo_evento"] ?>">Eliminar Evento</a></div>
                <hr />
                <br /><br />
                <?php } ?>
            </ul>
            <hr />
            <div id="paginador">
            <?php
                $indice = 0;
                for($j=1; $j<=$total_eventos; $j++){

                    if($j <= $num_eventos){
                        ?><a href="?pos=<?php echo $indice ?>" title="P&aacute;gina <?php echo $j ?>"><?php echo $j ?></a><?php
                    }

                    $indice += 10;
                }
                if(count($listar_eventos) == 10){
                    ?><a href="?pos=<?php echo $ultimo_evento;?>" title="P&aacute;gina <?php echo number_format($num_eventos,"0","",".") + 1 ?>"><?php echo number_format($num_eventos,"0","",".") + 1 ?></a><?php
                } else {
                    $newultimo = number_format($num_eventos,"0","",".") + 1;
                    echo "<span>". $newultimo ."</span>";
                }
            ?>
            </div>
            <hr />
            <div align="center"><button name="btn_crear" class="format-button" onclick="window.location='crearevento.php'">Crear un nuevo evento</button></div>
            <div align="center">
                <a href="pdf.php" target="_blank"><img src="img/pdf_logo.jpg" width="32" height="32" title="Generar documento PDF" /></a>
            </div>
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