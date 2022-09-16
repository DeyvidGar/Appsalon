<h1 class="nombre-pagina">Registrate</h1>
<p class="descripcion-pagina">Llena el siguiente formualario para crear una cuenta</p>

<?php include_once __DIR__ . '/../templates/alertas.php';?>

<form action="registrar-nueva-cuenta" method="POST" class="formulario">
    <div class="campo">
        <label for="nombre">Tu nombre:</label>
        <input type="text" id="nombre" name="nombre" placeholder="Tu nombre" value="<?php echo sanitizar($usuario->nombre);?>">
    </div>

    <div class="campo">
        <label for="apellido">Tu apellido:</label>
        <input type="text" id="apellido" name="apellido" placeholder="Tu apellido" value="<?php echo sanitizar($usuario->apellido);?>">
    </div>

    <div class="campo">
        <label for="telefono">Tu telefono:</label>
        <input type="number" id="telefono" name="telefono" placeholder="ej. 2928482912" value="<?php echo sanitizar($usuario->telefono);?>">
    </div>

    <div class="campo">
        <label for="email">Tu correo electronico:</label>
        <input type="email" id="email" name="email" placeholder="email" value="<?php echo sanitizar($usuario->email);?>">
    </div>

    <div class="campo">
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" placeholder="Tu contraseña">
    </div>

    <input type="submit" value="Registrarme" class="boton">
</form>

<div class="acciones">
    <a href="/">¿Ya tienes una cuenta? Inicia sesión aquí</a>
    <a href="/olvide-password">¿Olvidaste tu password?</a>
</div>