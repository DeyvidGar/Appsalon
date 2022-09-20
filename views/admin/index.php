<h1 class="nombre-pagina">Panel de Administracion</h1>

<?php include_once __DIR__ . '/../templates/barraAdmin.php'; ?>

<h2>Buscar citas</h2>

<div class="busqueda">
    <form action="" class="formulario">
        <div class="campo">
            <label for="fecha">Fecha:</label>
            <input type="date" id="fecha" name="fecha" value="<?php echo $fecha;?>">
        </div>
    </form>
</div>

<?php include_once __DIR__ . '/../templates/alertas.php';?>

<?php if (count($citas) === 0){?>
    <h4 class="no-citas">Este dia no hay citas.</h4>
<?php }?>


<div class="citas-admin" id="citas-admin">
    <ul class="contenedor-citas">
        <?php 
        $aux = 0;
        foreach($citas as $key => $cita):
            if($aux !== $cita->id):
                $total = 0;
                ?>
                <li>
                    <div class="informacion">
                        <p>ID: <span><?php echo $cita->id; ?></span></p>
                        <p>Nombre: <span><?php echo $cita->cliente; ?></span></p>
                        <p>Telefono: <span><?php echo $cita->telefono;?></span></p>
                        <p>Email: <span><?php echo $cita->email;?></span></p>
                    </div>
                </li>
                <h3>Servicios</h3>
                <?php
                $aux = $cita->id;
            endif; 
            ?>

            <p class="servicios-admin"><?php echo $cita->servicios. ' ' . $cita->precio; ?></p>

            <?php 
        
            //METODO PARA VERIFICAR SI NOS ENCONTRAMOS EN EL ULTIMO SERVICIO DEL ID ACTUAL DENTRO DE LA ITERACION DE LOS SERVICIOS
            $actual = $cita->id; 
            $proximo =  $citas[$key + 1]->id ?? 0;

            $total += $cita->precio;

            //la funcion devuelve true si  se encuentra en el ultimo arreglo del la cita actual
            if(esUltimo($actual, $proximo)){
                ?>
                <p class="total">Total: $<span><?php echo $total;?></span></p>

                <form action="/api/citas/eliminar" method="POST">
                    <input type="hidden" name="id" value="<?php echo $cita->id?>">
                    <input type="submit" value="Eliminar cita" class="boton-eliminar">
                </form>

                <?php
            }

        endforeach;
        ?>
    </ul>
</div>

<?php $script = "<script src='build/js/buscarFecha.js'></script>";?>