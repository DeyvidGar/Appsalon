<?php 

require_once __DIR__ . '/../includes/app.php';

//importamos las clases que vallamos a ocupar que se cargan automaticamente o manualmente

use Controllers\AdminController;
use Controllers\APIController;
use Controllers\LoginController;
use Controllers\CitaController;
use Controllers\ServicioController;
use MVC\Router;

$router = new Router();

//iniciar sesion
$router->get('/', [LoginController::class, 'login']);
$router->post('/', [LoginController::class, 'login']);
//cerrar sesion
$router->get('/logout', [LoginController::class, 'logout']);

//pagina si olvidaste la contraseña
$router->get('/olvide-password', [LoginController::class, 'olvide_password']);
$router->post('/olvide-password', [LoginController::class, 'olvide_password']);

//siel usario existe podra escribir una nueva password en la siguiente paguina
$router->get('/crear-nueva-password', [LoginController::class, 'crear_nueva_password']);
$router->post('/crear-nueva-password', [LoginController::class, 'crear_nueva_password']);

//registrar nuevos usuarios
$router->get('/registrar-nueva-cuenta', [LoginController::class, 'registrar_nueva_cuenta']);
$router->post('/registrar-nueva-cuenta', [LoginController::class, 'registrar_nueva_cuenta']);

//confirmar con token los usuarios que se registren
$router->get('/confirmar-cuenta', [LoginController::class, 'confirmar_cuenta']);
$router->post('/confirmar-cuenta', [LoginController::class, 'confirmar_cuenta']);

//pagina de indicaciones, revisar email
$router->get('/mensaje', [LoginController::class, 'mensaje']);

//ZONA PRIVADA - NECESITA REGISTRARSE
$router->get('/cita', [CitaController::class, 'index']);
$router->get('/admin', [AdminController::class, 'index']);

//API SERVICIOS
$router->get('/api/servicios', [APIController::class, 'index']);
$router->post('/api/citas', [APIController::class, 'guardar']);
$router->post('/api/citas/eliminar', [APIController::class, 'eliminar']);

//PANEL DE ADMINISTRACION crud servicios
$router->get('/servicios', [ServicioController::class, 'index']);
$router->get('/servicios/nuevo-servicio', [ServicioController::class, 'crear']); //muestra los datos
$router->post('/servicios/nuevo-servicio', [ServicioController::class, 'crear']); //envia datos
$router->get('/servicios/actualizar', [ServicioController::class, 'actualizar']);//muestra los datos
$router->post('/servicios/actualizar', [ServicioController::class, 'actualizar']);//envia datos
$router->post('/servicios/eliminar', [ServicioController::class, 'eliminar']);



// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();