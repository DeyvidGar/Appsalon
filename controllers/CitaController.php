<?php 

namespace Controllers;

use MVC\Router;

class CitaController {
    public static function index( Router $router){

        if(!isset($_SESSION)) {
            session_start();
        };

        //USAMOS UNA FUNCION HELPER PATA AUTENTICAR AL USUARIO ANTER DE RENDERIZAR LA PAGINA
        isAuth();
// debuguear($_SESSION);
        $router->render('cita/index', [
            'id' => $_SESSION['id'],
            'nombre' => $_SESSION['nombre'],
            'apellido' => $_SESSION['apellido']
        ]);
    }
}