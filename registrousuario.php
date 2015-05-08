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
                <form name="frm-reguser" action="gestionusuarios.php" method="POST" enctype="multipart/form-data">
                <table>
                    <br /><br />
                    <tr>
                        <label>Nombre: </label>
                        <input type="text" name="txt_nombre" required />
                    </tr>
                    <br /><br />
                    <tr>
                        <label>Apellido: </label>
                        <input type="text" name="txt_apellido" required />
                    </tr>
                    <br /><br />
                    <tr>
                        <label>Nombre de usuario: </label>
                        <input type="text" name="txt_login" required />
                    </tr>
                    <br /><br />
                    <tr>
                        <label>Contrase&ntilde;a: </label>
                        <input type="password" name="pwd_pass" required />
                    </tr>
                    <br /><br />
                    <tr>
                        <div align="center"><input type="submit" name="btn_registrar" class="format-button" value="Registrarse" />
                        <button class="format-button" onclick="window.location='index.php'">Volver</button></div>
                    </tr>
                </table>
                </form>
            </ul>
        </article>
        
    </div>
</body>
</html>