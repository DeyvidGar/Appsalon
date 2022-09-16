<h1 class="nombre-pagina">Crear una nueva cita</h1>
<p class="descripcion-pagina">Elige tus servicios a continuación</p>

<div id="app">

    <nav class="tabs">
        <button type="button" data-paso="1" class="actual">Servicios</button>
        <button type="button" data-paso="2">Informacion cita</button>
        <button type="button" data-paso="3">Resumen</button>
        <button type="button" data-paso="4">Mi perfil</button>
    </nav>

    <div class="seccion" id="paso-1">
        <h2>Servicios</h2>
        <p class="indicaciones">Elige tus servicios a continuación</p>
        <div class="listado-servicios" id="servicios"></div>
    </div>
    <div class="seccion" id="paso-2">
        <h2>Tus datos y citas</h2>
        <p class="indicaciones">Coloca tus datos y fecha de tu cita</p>
        
        <form action="" class="formulario">
            <div class="campo">
                <input type="hidden" value="<?php echo $id;?>" id="idusuario">
            </div>
            <div class="campo">
                <label for="nombre">Nombre:</label>
                <input 
                    type="text" 
                    placeholder="tu nombre" 
                    id="nombre"
                    value="<?php echo $nombre. " " . $apellido; ?>"
                    disabled>
            </div>
            <div class="campo">
                <label for="fecha">Fecha:</label>
                <input 
                    type="date"
                    min="<?php echo date('Y-m-d'/**,strtotime('+1 day') */ ); // si queremos que la citas se programen un dia despues del actual?>"
                    id="fecha"/>
            </div>
            <div class="campo">
                <label for="hora">Hora:</label>
                <input type="time" id="hora">
            </div>
        </form>
    </div>
    <div class="seccion" id="paso-3">
        <div class="listado-resumen" id="resumen"></div>
    </div>
    
    <div class="seccion" id="paso-4">
        <div class="perfil-contenedor" id="perfil">
            <h2>Hola, <?php echo $nombre. " " . $apellido; ?></h2>
            <a href="/logout" class="boton">Cerrar Session</a>
        </div>
    </div>

    <div class="paginacion">
        <button type="button" class="boton" id="boton-anterior">&laquo; Anterior</button>
        <button type="button" class="boton" id="boton-siguiente">Siguiente &raquo;</button>
    </div>
</div>

<?php $script="
    <script src='build/js/app.js'></script>
    <script src='//cdn.jsdelivr.net/npm/sweetalert2@11'></script>
";?>