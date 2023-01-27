<?php

    class Valoracion extends Conectar{

        public function get_valoracion(){
            $conectar = parent::conexion();
            parent::set_names();
            $sql = "SELECT * FROM tm_valoración WHERE est = 1;";
            $sql = $conectar->prepare($sql);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }
    }

?>