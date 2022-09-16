<div class="campo">
    <label for="nombre">Nombre:</label>
    <input 
        type="text" 
        id="nombre" 
        class="" 
        placeholder="Nombre del servicio" 
        value="<?php echo $servicio->nombre; ?>"
        name="nombre"
    />
</div>

<div class="campo">
    <label for="precio">Precio:</label>
    <input 
        type="number" 
        id="precio" 
        placeholder="Precio del servicio" 
        value="<?php echo $servicio->precio; ?>"
        name="precio"
    />
</div>