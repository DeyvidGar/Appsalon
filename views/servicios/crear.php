<h1 class="nombre-pagina">Nuevo Servicio</h1>
<p class="descripcion-pagina">Agrega un nuevo servicios</p>

<?php include_once __DIR__ . '/../templates/barraAdmin.php'; ?>

<form action="/servicios/nuevo-servicio" class="formulario" method="POST">
    
    <?php
        require_once __DIR__.'/../servicios/formulario.php';
        include_once __DIR__ . '/../templates/alertas.php'; 
    ?>

    <input type="submit" value="Crear Servicio" class="boton">

</form>