<?php

    require_once("class/users.php");

    if($_SESSION["usuario_act"]){

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
      <h2>Agregar un nuevo evento</h2>
      <article>
          <form name="frm-regevent" action="gestioneventos.php" method="POST" enctype="multipart/form-data">
          <table>
              <br /><br />
              <tr>
                  <label>Titulo del evento: </label>
                  <input type="text" name="txt_titulo" required />
              </tr>
              <br /><br />
              <tr>
                  <label>Inicio del evento: </label>
                  <input type="text" name="txt_inicio" placeholder="Ej: Lunes 9:00 AM" required />
              </tr>
              <br /><br />
              <tr>
                  <label>Culminaci&oacute;n del evento: </label>
                  <input type="text" name="txt_fin" placeholder="Ej: Lunes 12:00 PM" required />
              </tr>
              <br /><br />
              <tr>
                  <label>Foto de evento (opcional): </label>
                  <input type="file" name="fle_foto" />
              </tr>
              <br /><br />
              <tr>
                  <label>Descripci&oacute;n del evento: </label><br /><br />
                  <textarea name="txa_descripcion" rows="10" cols="50"></textarea>
              </tr>
              <br /><br />
              <tr>
                  <div align="center"><input class="format-button" type="submit" name="btn_submit" value="Crear Evento"/>
                  <button class="format-button" onclick="window.location='home.php'">Volver</button></div>
              </tr>
          </table>
          </form>
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