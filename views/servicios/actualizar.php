<h1 class="nombre-pagina">Actualizar Servicios</h1>
<p class="descripcion-pagina">Actualizar un servicios</p>

<?php include_once __DIR__ . '/../templates/barraAdmin.php'; ?>


<form method="POST" class="formulario">

    <?php
        require_once __DIR__.'/../servicios/formulario.php';
        include_once __DIR__ .'/../templates/alertas.php'; 
    ?>

    <input type="submit" value="Actualizar Servicio" class="boton">
</form>