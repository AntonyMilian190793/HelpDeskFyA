<?php

    //librerias necesarias para que el proyecto pueda enviar mails
    require("class.phpmailer.php");
    include("class.smtp.php");

    //llamada de las clases necesarias que usaran en el envio del mail
    require_once("../config/conexion.php");
    require_once("../models/Ticket.php");

    class Email extends PHPMailer{

        protected $gCorreo = ''; //variable que contiene el correo destinatario
        protected $gContrasena = ''; //varibale que tiene la contraseña distanatario

        public function ticket_abierto($ticket_id){
            $ticket = new Ticket();
            $datos = $ticket->listar_ticket_x_id($ticket_id);

            foreach($datos as $row){
                $id = $row["ticket_id"];
                $usu = $row["usu_nom"];
                $titulo = $row["tick_titulo"];
                $categoria = $row["cat_nom"];
                $correo = $row["usu_correo"];
            }

            //
            $this->IsSMTP();
            $this->Host = 'smtp.office365.com';// aqui el server smtp.gmail.com
            $this->Port = 587;//Aqui el puerto 25 
            $this->SMTPAuth = true;
            $this->Username = $this->gCorreo;
            $this->Password = $this->gContrasena;
            $this->From = $this->gCorreo;
            $this->SMTPSecure = 'tls';
            $this->FromName = $this->tu_nombre = "Ticket Abierto ".$id;
            $this->CharSet = 'UTF8';
            $this->addAddress($correo);
            // $this->addAddress("antonymilian19@outlook.com");
            $this->WordWrap = 50;
            $this->IsHTML(true);
            $this->Subject = "Ticket Abierto";

            $cuerpo = file_get_contents('../public/NuevoTicket.html'); /* Ruta del template en formato HTML */
            /* parametros del template a remplazar */
            $cuerpo = str_replace("xnroticket", $id, $cuerpo);
            $cuerpo = str_replace("lblNomUsu", $usu, $cuerpo);
            $cuerpo = str_replace("lblTitu", $titulo, $cuerpo);
            $cuerpo = str_replace("lblCate", $categoria, $cuerpo);

            $this->Body = $cuerpo;
            $this->AltBody = strip_tags("Ticket Abierto");
            return $this->Send();
        }

        public function ticket_cerrado($ticket_id){
            $ticket = new Ticket();
            $datos = $ticket->listar_ticket_x_id($ticket_id);

            foreach($datos as $row){
                $id = $row["ticket_id"];
                $usu = $row["usu_nom"];
                $titulo = $row["tick_titulo"];
                $categoria = $row["cat_nom"];
                $correo = $row["usu_correo"];
            }

            //
            $this->IsSMTP();
            $this->Host = 'smtp.office365.com';// aqui el server smtp.gmail.com
            $this->Port = 587;//Aqui el puerto 25 
            $this->SMTPAuth = true;
            $this->Username = $this->gCorreo;
            $this->Password = $this->gContrasena;
            $this->From = $this->gCorreo;
            $this->SMTPSecure = 'tls';
            $this->FromName = $this->tu_nombre = "Ticket Cerrado ".$id;
            $this->CharSet = 'UTF8';
            $this->addAddress($correo);
            // $this->addAddress("antonymilian19@outlook.com");
            $this->WordWrap = 50;
            $this->IsHTML(true);
            $this->Subject = "Ticket Cerrado";

            $cuerpo = file_get_contents('../public/CerradoTicket.html'); /* Ruta del template en formato HTML */
            /* parametros del template a remplazar */
            $cuerpo = str_replace("xnroticket", $id, $cuerpo);
            $cuerpo = str_replace("lblNomUsu", $usu, $cuerpo);
            $cuerpo = str_replace("lblTitu", $titulo, $cuerpo);
            $cuerpo = str_replace("lblCate", $categoria, $cuerpo);

            $this->Body = $cuerpo;
            $this->AltBody = strip_tags("Ticket Cerrado");
            return $this->Send();
            
        }

        public function ticket_asignado($ticket_id){
            $ticket = new Ticket();
            $datos = $ticket->listar_ticket_x_id($ticket_id);

            foreach($datos as $row){
                $id = $row["ticket_id"];
                $usu = $row["usu_nom"];
                $titulo = $row["tick_titulo"];
                $categoria = $row["cat_nom"];
                $correo = $row["usu_correo"];
            }

            //
            $this->IsSMTP();
            $this->Host = 'smtp.office365.com';// aqui el server smtp.gmail.com
            $this->Port = 587;//Aqui el puerto 25 
            $this->SMTPAuth = true;
            $this->Username = $this->gCorreo;
            $this->Password = $this->gContrasena;
            $this->From = $this->gCorreo;
            $this->SMTPSecure = 'tls';
            $this->FromName = $this->tu_nombre = "Ticket Asignado ".$id;
            $this->CharSet = 'UTF8';
            $this->addAddress($correo);
            // $this->addAddress("antonymilian19@outlook.com");
            $this->WordWrap = 50;
            $this->IsHTML(true);
            $this->Subject = "Ticket Asignado";

            $cuerpo = file_get_contents('../public/AsignarTicket.html'); /* Ruta del template en formato HTML */
            /* parametros del template a remplazar */
            $cuerpo = str_replace("xnroticket", $id, $cuerpo);
            $cuerpo = str_replace("lblNomUsu", $usu, $cuerpo);
            $cuerpo = str_replace("lblTitu", $titulo, $cuerpo);
            $cuerpo = str_replace("lblCate", $categoria, $cuerpo);

            $this->Body = $cuerpo;
            $this->AltBody = strip_tags("Ticket Asignado");
            return $this->Send();
            
        }

    }


?>