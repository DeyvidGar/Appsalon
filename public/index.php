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


//NOTAS PARA EMPEZAER EL PROYECTO EL PACKAGE.JSON CONTIENE LAS DEPENDENCIAS Y GENERA LA CARPETA DE NODE_MODULES Y PACKAGE-LOCK
//PARA CORRER EL PACKAGE Y SUS DEPENDENCIAS USAMOS npm install
//PARA EJECUTAR TAREAS EN EL PACKAGE PODEMOS USAR
//npm run 'nombre del script que esta en el package'
//
//PARA CORRER COMPOSER DEBEMOS CORRER EL SCRIPT EN LA TERMINAL
// composer init
//nosgenera el json de composer dentro de el escribimos el autoload que carga automaticamente los archivos que usemos en otros archivos
//dentro del json de composer escribimos el autoload y dentro de el los namespaces que usemos en el proyecto y la ubicacion en donde se encuentra el archivo
//ejemplo de lo que generamos(con el auto load escrito a mano)
// {
//     "name": "david/app-salon_php_mvc_js_sass",
//     "description": "Proyecto PHP 8, MVC, SQL, SASS, GULP",
//     "type": "project",
//     "autoload": {
//         "psr-4": {
//             "MVC\\": "./",
//             "Model\\": "./models",
//             "Controllers\\": "./controllers"
//         }
//     },
//     "authors": [
//         {
//             "name": "David gs",
//             "email": "david@gmail.com"
//         }
//     ],
//     "require": {}
// }
// despues de hacerle cambios al archivo corremos el comando: composer update

//PARA LE DEPLOYMENT NOTAS;
// para el deployment debemos de hacer algunas configuraciones como el archivo .env que son variables de entorno para no mostrar el nombre del host usuario bd y pass
//Dependencia para leer las varialbes de entorno: composer require vlucas/phpdotenv
// $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
// $dotenv->safeload();
//PARA EL DEPLOYMENT DEBEMOS OCULTAR ESTA INF EN UN ARCHIVO .ENV QUE CONTIENE VARIBLES DE ENTORNO QUE SERAN DE FORMA PRIVADA
// $db = mysqli_connect(
//     $_ENV['DB_HOST'], 
//     $_ENV['DB_USER'], 
//     $_ENV['DB_PASS'], 
//     $_ENV['DB_BD'] 
// );

//para que el servidor se diriga a el archibo public y de ahi abra la app creamos el archivo .htacccess

// en .gitignore colocamos el nombre de los archivos y carpetas que no deseamos subir a produccion como lo son herramientas de diseno node etc.

//para subir el repo a gir desde git emplear los comandos que git nos proporcina
// git init 
// git add . (para todos los archivos)
// git commit -m "Primer deployment"
// git branch -M main (el branch main es la rama pricipal ojo con esta rama leer documentacion para mas detalles
// git remote add origin https://github.com/DeyvidGar/Appsalon.git
// git push -u origin main (para subirlo al remote anterior. Aqui podemos hacer push al servicio de hosting para subir a produccion los cambios ejemplo: git push heroku main)

//para la base de datos
// heroku config | grep CLEARDB_DATABASE_URL
// CLEARDB_DATABASE_URL: mysql://b09728cd453532:bd860c9d@us-cdbr-east-06.cleardb.net/heroku_3e94bb146af57a1?reconnect=true

//usuario
// b09728cd453532
//pass
// bd860c9d
//host
// us-cdbr-east-06.cleardb.net
//bd
// heroku_3e94bb146af57a1

//localmente tenemos asignado en nuestras variables de entorno nuestra conneccion local para cambiar esos valores en producion aplicacmos los sigientes comandos
//PARA EL HOST
// heroku config:set DB_HOST=us-cdbr-east-06.cleardb.net