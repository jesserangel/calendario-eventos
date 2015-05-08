<?php

    session_start();

    class Usuarios{

        private $usuario = array();

        public function ingresoUsuario(){

            if(empty($_POST["txt_login"]) or empty($_POST["pwd_pass"])){

                header("Location: index.php?error=1");

            } else {

                $mysqli = new Mysqli("localhost","root","");
                $mysqli->query("SET NAMES 'utf8'");
                $mysqli->select_db("calendario_eventos");

                $rs_usuario = $mysqli->query("CALL ingreso_usuarios('".$_POST["txt_login"]."','".md5($_POST["pwd_pass"])."')");

                if($rs_usuario->num_rows){

                    while($log = $rs_usuario->fetch_array()){

                        $_SESSION["usuario_act"] = $log["login_usuario"];
                        $_SESSION["usuario_id"] = $log["id_usuario"];

                    }

                    header("Location: home.php");

                } else {

                    header("Location: index.php?error=2");

                }

            }

        }

        public function addUsuarios($nombre, $apellido, $login, $pass){

            $mysqli = new Mysqli("localhost", "root", "");
            $mysqli->select_db("calendario_eventos");
            $mysqli->query("SET NAMES 'utf8'");

            $mysqli->query("CALL registrar_usuarios('".$nombre."', '".$apellido."', '".$login."', '".md5($pass)."')");

            header("Location: index.php?msg=1");



        }

    }

?>