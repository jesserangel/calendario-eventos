<?php

    class ProcesarEvento{

        private $eventos = array();

        public static function replaceSpaces($palabra){

            $palabra = trim($palabra);
            $palabra = str_replace(" ", "-", $palabra);
            return $palabra;

        }

        public static function replaceGuiones($palabra){

            $palabra = trim($palabra);
            $palabra = str_replace("-", " ", $palabra);
            return $palabra;

        }

        public function getEventos($id_usuario, $inicio){

            $mysqli = new mysqli("localhost","root","");
            $mysqli->select_db("calendario_eventos");
            $mysqli->query("SET NAMES 'utf8'");

            $rs_evento = $mysqli->query("CALL listar_eventos('".$id_usuario."', '".$inicio."')");

            while($listado = $rs_evento->fetch_array()){

                $this->eventos[] = $listado;

            }

            return $this->eventos;

        }

        public function getEventosPDF($id_usuario){

            $mysqli = new mysqli("localhost","root","");
            $mysqli->select_db("calendario_eventos");
            $mysqli->query("SET NAMES 'utf8'");

            $rs_evento = $mysqli->query("CALL listar_eventos_pdf('".$id_usuario."')");

            while($listado = $rs_evento->fetch_array()){

                $this->eventos[] = $listado;

            }

            return $this->eventos;

        }

        public function getCountEventos($id_usuario){

            $mysqli = new mysqli("localhost","root","");
            $mysqli->select_db("calendario_eventos");
            $mysqli->query("SET NAMES 'utf8'");

            $rs_evento = $mysqli->query("CALL total_eventos($id_usuario)");

            while($listado = $rs_evento->fetch_array()){

                $total = $listado["cantidad"];

            }

            return $total;

        }

        public function getEventosByName($name_event){

            $mysqli = new mysqli("localhost","root","");
            $mysqli->select_db("calendario_eventos");
            $mysqli->query("SET NAMES 'utf8'");

            $rs_evento = $mysqli->query("CALL listar_eventos_name('".$name_event."')");

            while($listado = $rs_evento->fetch_array()){

                $this->eventos[] = $listado;

            }

            return $this->eventos;

        }

        public function addEventos($tit, $desc, $ini, $foto, $fin, $id_usuario){

            $mysqli = new mysqli("localhost","root","");
            $mysqli->select_db("calendario_eventos");
            $mysqli->query("SET NAMES 'utf8'");

            $custom_tit = ProcesarEvento::replaceSpaces($tit);

            $mysqli->query("CALL registrar_eventos('".$custom_tit."', '".$desc."', '".$ini."', '".$foto."', '".$fin."',$id_usuario)");

            header("Location: home.php");

        }

        public function deleteEventos($name_event){

            $mysqli = new mysqli("localhost", "root", "");
            $mysqli->select_db("calendario_eventos");
            $mysqli->query("SET NAMES 'utf8'");

            $mysqli->query("CALL eliminar_eventos('".$name_event."')");

            /*echo '
              <html lang="es-VE">
              <head>
                  <script>alert("Evento eliminado con exito!")</script>
              </head>
              </html>
            ';*/

            header("Location: home.php");

        }

        public function updateEventos($id, $tit, $desc, $ini, $foto, $fin){

            $mysqli = new mysqli("localhost", "root", "");
            $mysqli->select_db("calendario_eventos");
            $mysqli->query("SET NAMES 'utf8'");

            $custom_tit = ProcesarEvento::replaceSpaces($tit);

            $mysqli->query("CALL actualizar_eventos('".$id."', '".$custom_tit."', '".$desc."', '".$ini."', '".$foto."', '".$fin."')");

            header("Location: home.php");
        }

        public function searchEventos($busqueda){

            $mysqli = new mysqli("localhost", "root", "");
            $mysqli->select_db("calendario_eventos");
            $mysqli->query("SET NAMES 'utf8'");

            $rs_search = $mysqli->query("SELECT * FROM tbl_eventos WHERE titulo_evento LIKE '%".$busqueda."%' ORDER BY id_evento DESC");

            while($listado = $rs_search->fetch_array()){

                $this->eventos[] = $listado;

            }

            return $this->eventos;

        }

    }

?>