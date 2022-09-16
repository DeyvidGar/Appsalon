<h1 class="nombre-pagina">Login</h1>
<p class="descripcion-pagina">Inicia sesión con tus datos</p>

<?php include_once __DIR__ . '/../templates/alertas.php';?>

<form action="/" method="POST" class="formulario">

    <div class="campo">
        <label for="email">Ingresa tu email:</label>
        <input 
            type="email"
            id="email"
            name="email"
            placeholder="Tu email"
            value="<?php echo $email; ?>"
        />
    </div>

    <div class="campo">
        <label for="password">Contraseña:</label>
        <input 
            type="password"
            id="password"
            name="password"
            placeholder="Tu contraseña"
        />
    </div>

    <input type="submit" value="Iniciar sesión" class="boton">
</form>
<div class="acciones">
    <a href="/registrar-nueva-cuenta">¿Aun no tienes una cuenta? Registrate aquí</a>
    <a href="/olvide-password">¿Olvidaste tu password? click aqui</a>
</div>