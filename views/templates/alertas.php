<?php

//primero se encargar de leer los tipos de errores, ya que pueden existir de tipo error o de tipo correctos

foreach($alertas as $key => $mensajes){
    foreach($mensajes as $mensaje){ //iteramos los mensajes del primer key, y los mostramos
        ?>
        <div class="alerta <?php echo $key;?>"><?php echo $mensaje;?></div>
        <?php
    }
}
