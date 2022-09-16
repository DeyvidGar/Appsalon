<h1 class="nombre-pagina">Servicios</h1>
<p class="descripcion-pagina">Administracion de servicios</p>

<?php include_once __DIR__ . '/../templates/barraAdmin.php'; ?>

<?php foreach($servicios as $key => $servicio): //echo $key;?>
    
    <div class="servicios-admin">
        <p><span>Nombre: </span><?php echo $servicio->nombre; ?></p>
        <p><span>Precio: </span><?php echo $servicio->precio; ?></p>
    </div>

    <div class="acciones">
        <form action="/servicios/eliminar" method="POST">
            <input type="hidden" value="<?php echo $servicio->id?>" name="id">
            <input type="submit" value="Eliminar" class="boton-eliminar">
        </form>
        <a class="boton-actualizar" href="/servicios/actualizar?id=<?php echo $servicio->id;?>">Actualizar</a>
    </div>
<?php endforeach;?>


