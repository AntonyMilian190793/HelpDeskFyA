<?php

    require_once("../config/conexion.php");
    require_once("../models/Valoracion.php");
    $valor = new Valoracion();

    switch($_GET["op"]){
        case "combo":
            $datos = $valor->get_valoracion();

            if(is_array($datos) == true and count($datos) > 0){
                foreach($datos as $row){
                    $html.= "<option value='".$row['valor_id']."'>".$row['valor_nom']."</option>";
                }
                echo $html;
            }

        break;    
    }

?>