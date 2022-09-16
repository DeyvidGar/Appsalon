<h1 class="nombre-pagina">¿Olvidaste tu contraseña?</h1>
<p class="descripcion-pagina">Resiviras un correo electronico para restablecer tu contraseña.</p>

<?php include_once __DIR__.'/../templates/alertas.php'?>

<form action="/olvide-password" method="POSt" class="formulario">
    <div class="campo">
        <label for="email">Escribe tu email:</label>
        <input type="text" id="email" name="email" placeholder="Tu correo electronico">
    </div>

    <input type="submit" class="boton" value="Recibir indicaciones">
</form>

<div class="acciones">
    <a href="/">¿Ya tienes una cuenta? Inicia sesión aquí</a>
    <a href="/registrar-nueva-cuenta">¿Aun no tienes una cuenta? Registrate aquí</a>
</div>