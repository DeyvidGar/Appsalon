<?php

//vamos a ocupar 2 arreglos, el primero se encargar de leer los tipos de errores que podemos enviar
// el segundo mostrara el mensaje de alerta
foreach($alertas as $key => $mensajes){
    // echo $key;//en este primer arreglo solo podemos acceer/interactuar con le key, ya que pueden existir de tipo error o de tipo correctos
    foreach($mensajes as $mensaje){ //iteramos los mensajes del primer key, y los mostramos
        ?>
        <div class="alerta <?php echo $key;?>"><?php echo $mensaje;?></div>
        <?php
    }
}
