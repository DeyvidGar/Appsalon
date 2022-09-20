<?php
namespace Controllers;

use Model\Servicios;
use MVC\Router;

class ServicioController {

    public static function index( Router $router ){

        //validar usuario
        isAdmin();

        $servicios = Servicios::all();

        $router->render('servicios/index', [
            'nombre' => $_SESSION['nombre'],
            'servicios' => $servicios
        ]);
    }
    
    public static function crear( Router $router ){
        //validar usuario
        isAdmin();

        $servicio = new Servicios;

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $servicio->sincronizar($_POST);
            
            $alertas = $servicio->validarServicio();

            if(empty($alertas)){
                $resultado = $servicio->guardar();
                
                if($resultado['resultado']){
                    $alertas = Servicios::setAlerta('exito', 'Se ha creado un nuevo servicio.');
                } else {
                    $alertas = Servicios::setAlerta('error', 'Upss... Algo salio mal.');
                }
            }
            
        }
        
        $alertas = Servicios::getAlertas();

        $router->render('servicios/crear', [
            'nombre' => $_SESSION['nombre'],
            'servicio' => $servicio,
            'alertas' => $alertas
        ]);
    }

    public static function actualizar( Router $router){
        //validar usuario
        isAdmin();

        if(!is_numeric($_GET['id'])) return;

        $servicio = Servicios::find($_GET['id']);

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $servicio->sincronizar($_POST);
            
            $alertas = $servicio->validarServicio();

            if(empty($alertas)){
                $resultado = $servicio->guardar();
                
                if($resultado){
                    $alertas = Servicios::setAlerta('exito', 'Se ha Actualizado un nuevo servicio.');
                } else {
                    $alertas = Servicios::setAlerta('error', 'Upss... Algo salio mal.');
                }
            }
        }

        $alertas = Servicios::getAlertas();

        $router->render('servicios/actualizar', [
            'nombre' => $_SESSION['nombre'],
            'servicio' => $servicio,
            'alertas' => $alertas
        ]);
    }

    public static function eliminar(){
        //validar usuario
        isAdmin();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $servicio = Servicios::find($_POST['id']);

            $servicio->eliminar();

            header('Location: /servicios');
        }
    }
}