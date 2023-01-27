<?php

    class Ticket extends Conectar{

    public function insert_ticket($usu_id, $cat_id, $tick_titulo, $tick_descrip){
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "INSERT INTO tm_ticket (ticket_id, usu_id, cat_id, tick_titulo, tick_descrip, tick_estado, fech_crea, usu_asig, fech_asig, est) VALUES (NULL, ?, ?, ?, ?, 'Abierto', now(), NULL, NULL, '1');";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $usu_id);
        $sql->bindValue(2, $cat_id);
        $sql->bindValue(3, $tick_titulo);
        $sql->bindValue(4, $tick_descrip);
        $sql->execute();

        $sql1 = "select last_insert_id() as 'ticket_id';";
        $sql1 = $conectar->prepare($sql1);
        $sql1->execute();
        return $resultado = $sql1->fetchAll(pdo::FETCH_ASSOC);
    }

        public function listar_ticket_x_usu($usu_id){
            $conectar = parent::conexion();
            parent::set_names();
            $sql = "SELECT tm_ticket.ticket_id, 
            tm_ticket.usu_id, 
            tm_ticket.cat_id, 
            tm_ticket.tick_titulo, 
            tm_ticket.tick_descrip,
            tm_ticket.tick_estado,
            tm_ticket.fech_crea,
            tm_ticket.usu_asig,
            tm_ticket.fech_asig,
            tm_usuario.usu_nom, 
            tm_usuario.usu_ape, 
            tm_categoria.cat_nom 
            FROM tm_ticket 
            INNER JOIN tm_categoria ON tm_ticket.cat_id = tm_categoria.cat_id 
            INNER JOIN tm_usuario ON tm_ticket.usu_id = tm_usuario.usu_id 
            WHERE 
            tm_ticket.est = 1 
            AND tm_usuario.usu_id=?";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1, $usu_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();

    }

    public function listar_ticket_x_id($ticket_id){
        $conectar = parent::conexion();
        parent::set_names();
        $sql="SELECT 
            tm_ticket.ticket_id,
            tm_ticket.usu_id,
            tm_ticket.cat_id,
            tm_ticket.tick_titulo,
            tm_ticket.tick_descrip,
            tm_ticket.tick_estado,
            tm_ticket.fech_crea,
            tm_usuario.usu_nom,
            tm_usuario.usu_ape,
            tm_usuario.usu_correo,
            tm_categoria.cat_nom
            FROM 
            tm_ticket
            INNER join tm_categoria on tm_ticket.cat_id = tm_categoria.cat_id
            INNER join tm_usuario on tm_ticket.usu_id = tm_usuario.usu_id
            WHERE
            tm_ticket.est = 1
            AND tm_ticket.ticket_id = ?";
        $sql = $conectar->prepare($sql);
        $sql -> bindValue(1, $ticket_id);
        $sql -> execute();
        return $resultado=$sql->fetchAll();
    }

    public function listar_ticket(){
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT tm_ticket.ticket_id, 
        tm_ticket.usu_id, 
        tm_ticket.cat_id, 
        tm_ticket.tick_titulo, 
        tm_ticket.tick_descrip,
        tm_ticket.tick_estado,
        tm_ticket.fech_crea,
        tm_ticket.usu_asig,
        tm_ticket.fech_asig, 
        tm_usuario.usu_nom, 
        tm_usuario.usu_ape, 
        tm_categoria.cat_nom 
        FROM tm_ticket 
        INNER JOIN tm_categoria ON tm_ticket.cat_id = tm_categoria.cat_id 
        INNER JOIN tm_usuario ON tm_ticket.usu_id = tm_usuario.usu_id 
        WHERE 
        tm_ticket.est = 1";
        $sql = $conectar->prepare($sql);
        $sql->execute();
        return $resultado = $sql->fetchAll();

    }

    public function listar_ticketdetalle_x_ticket($tick_id){
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT 
        td_ticketdelle.tickd_id,
        td_ticketdelle.tickd_descrip,
        td_ticketdelle.fech_crea,
        tm_usuario.usu_nom,
        tm_usuario.usu_ape,
        tm_usuario.rol_id
        FROM
        td_ticketdelle
        INNER JOIN tm_usuario on td_ticketdelle.usu_id = tm_usuario.usu_id
        WHERE 
        tick_id=?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $tick_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();

    }

    public function insert_ticketdetalle($tick_id ,$usu_id, $tickd_descrip){
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "INSERT INTO td_ticketdelle (tickd_id, tick_id, usu_id, tickd_descrip, fech_crea, est) VALUES (NULL, ?, ?, ?, now(), '1');";
        
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $tick_id);
        $sql->bindValue(2, $usu_id);
        $sql->bindValue(3, $tickd_descrip);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function update_ticket($tick_id){
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE tm_ticket SET tick_estado = 'Cerrado' WHERE ticket_id = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $tick_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function reabrir_ticket($tick_id){
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE tm_ticket SET tick_estado = 'Abierto' WHERE ticket_id = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $tick_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function update_ticket_asignacion($tick_id, $usu_asig){
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE tm_ticket SET usu_asig = ?, fech_asig = now() WHERE ticket_id = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $usu_asig);
        $sql->bindValue(2, $tick_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function insert_ticketdetalle_cerrar($tick_id ,$usu_id){
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "call sp_i_tickedetalle_01(?, ?)";
        
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $tick_id);
        $sql->bindValue(2, $usu_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function insert_ticketdetalle_reabrir($tick_id ,$usu_id){
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "	INSERT INTO td_ticketdelle 
        (tickd_id, tick_id, usu_id, tickd_descrip, fech_crea, est) 
        VALUES 
        (NULL, ?, ?, 'Ticket Re-Abierto', now(), '1');";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $tick_id);
        $sql->bindValue(2, $usu_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    
    public function get_usuario_total(){
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT COUNT(*) AS TOTAL FROM tm_ticket";
        $sql = $conectar->prepare($sql);
        $sql->execute();
        return $resultado = $sql->fetchAll(); 
    }

    public function get_usuario_totalabierto(){
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT COUNT(*) AS TOTAL FROM tm_ticket WHERE tick_estado = 'Abierto'";
        $sql = $conectar->prepare($sql);
        $sql->execute();
        return $resultado = $sql->fetchAll(); 
    }

    public function get_usuario_totalcerrado(){
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT COUNT(*) AS TOTAL FROM tm_ticket WHERE tick_estado = 'Cerrado'";
        $sql = $conectar->prepare($sql);
        $sql->execute();
        return $resultado = $sql->fetchAll(); 
    }

    public function get_ticket_grafico(){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="SELECT tm_categoria.cat_nom as nom,COUNT(*) AS total
            FROM   tm_ticket  JOIN  
                tm_categoria ON tm_ticket.cat_id = tm_categoria.cat_id  
            WHERE    
            tm_ticket.est = 1
            GROUP BY 
            tm_categoria.cat_nom 
            ORDER BY total DESC";
        $sql=$conectar->prepare($sql);
        $sql->execute();
        return $resultado=$sql->fetchAll();
    }  
}
?>    