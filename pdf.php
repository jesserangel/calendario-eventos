<?php
    require_once("class/class.php");
    require_once("class/users.php");
    require_once("libraries/ezpdf/class.ezpdf.php");

    $procesar = new ProcesarEvento();
    $listado = $procesar->getEventosPDF($_SESSION["usuario_id"]);

    // Crear el objeto
    $ezpdf = new Cezpdf();
    // Llamar al metodo selectFont y seleccionar la fuente a utilizar
    $ezpdf->selectFont("libraries/ezpdf/fonts/Courier.afm");

    // Carga de registros en el PDF mediante el array data
    for($i=0; $i<sizeof($listado); $i++){

        $data[] = array(
            "titulo" => $listado[$i]["titulo_evento"],
            "inicio" => $listado[$i]["inicio_evento"],
            "fin" => $listado[$i]["fin_evento"],
            "descripcion" => $listado[$i]["descripcion_evento"],
            "fecha" => $listado[$i]["fecha_evento"]
        );

    }

    // Titulos de cada una de las columnnas de la tabla del PDF
    $titles = array(
        "titulo" => "Titulo del Evento",
        "inicio" => "Inicio",
        "fin" => "Fin",
        "descripcion" => "Descripción del Evento",
        "fecha" => "Fecha"
    );

    // Configuración de la tabla
    $options = array(
        "shadeCol" => array(0.9, 0.9, 9.5), // Color de las celdas
        "xOrientation" => "center", // Orientacion de la tabla
        "width" => 520 // Ancho de la tabla
    );

    // Titulo del documento PDF
    $ezpdf->ezText("<b>Reporte de Eventos</b>\n",20);
    // Generando la tabla
    $ezpdf->ezTable($data, $titles, "", $options);
    // Generando el documento PDF
    $ezpdf->ezStream();

?>