<h1 class="nombre-pagina">Reestablece tu contraseña</h1>
<p class="descripcion-pagina">Coloca tu nueva contraseña acontinuacion.</p>

<?php include_once __DIR__ . '/../templates/alertas.php'?>

<?php if($error) return null;?>

    <form action="" method="POST" class="formulario">
        <div class="campo">
            <label for="password">Ingresa tu contraseña:</label>
            <input type="password" id="password" name="password" placeholder="Tu contraseña">
        </div>

        <input type="submit" value="Cambiar contraseña" class="boton">
    </form>

<?php //endif;?>

<div class="acciones">
    <a href="/">¿Ya tienes una cuenta? Inicia sesión aquí</a>
    <a href="/registrar-nueva-cuenta">¿Aun no tienes una cuenta? Registrate aquí</a>
</div>