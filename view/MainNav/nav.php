<?php
if($_SESSION["rol_id"] == 1){
    ?>
    
    <nav class="side-menu">
    <ul class="side-menu-list">
        <li class="red">
            <a href="..\Home\">
                <span class="glyphicon glyphicon-th"></span>
                <span class="lbl">Inicio</span>
            </a>
        </li>

        <li class="red">
            <a href="..\NuevoTicket\">
                <span class="glyphicon glyphicon-pencil"></span>
                <span class="lbl">Nuevo Ticket</span>
            </a>
        </li>

        <li class="red">
            <a href="..\ConsultarTicket\">
                <span class="glyphicon glyphicon-list-alt"></span>
                <span class="lbl">Consultar Ticket</span>
            </a>
        </li>
    </ul>
</nav>

    <?php
}else{
    ?>

<nav class="side-menu">
    <ul class="side-menu-list">
        <li class="red">
            <a href="..\Home\">
                <span class="glyphicon glyphicon-home"></span>
                <span class="lbl">Inicio</span>
            </a>
        </li>

        <li class="red">
            <a href="..\MntUsuario\">
                <span class="glyphicon glyphicon-user"></span>
                <span class="lbl">Mantenimiento Usuario</span>
            </a>
        </li>

        <li class="red">
            <a href="..\ConsultarTicket\">
                <span class="glyphicon glyphicon-file"></span>
                <span class="lbl">Consultar Ticket</span>
            </a>
        </li>

        <li class="red">
            <a href="..\MntPrioridad\">
                <span class="glyphicon glyphicon-folder-open"></span>
                <span class="lbl">Mnt. Prioridad</span>
            </a>
        </li>

        <li class="red">
            <a href="..\MntCategoria\">
                <span class="glyphicon glyphicon-paperclip"></span>
                <span class="lbl">Mnt. Áreas</span>
            </a>
        </li>

        <li class="red">
            <a href="..\MntSubCategoria\">
                <span class="glyphicon glyphicon-tasks"></span>
                <span class="lbl">Mnt. Tipos</span>
            </a>
        </li>


    </ul>
</nav>

    <?php
}
?>
