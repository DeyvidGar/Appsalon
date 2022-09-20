<?php

namespace Controllers;

use Model\AdminCitas;
use MVC\Router;

class AdminController {
    public static function index( Router $router){

        //validacion
        isAdmin();

        $alertas = AdminCitas::getAlertas();
        $alertaEliminar = $_GET['cita-eliminada'] ?? null;

        if($alertaEliminar){
            AdminCitas::setAlerta('exito', 'Se elimino correctamente la cita.');
        }

        date_default_timezone_set('America/Mexico_City');
        $fecha = $_GET['fecha'] ?? date('Y-m-d');

        $fechaExplode = explode('-', $fecha);
        //funcion checkdate que devuelve bool si existe la fecha
        if( !checkdate($fechaExplode[1], $fechaExplode[2], $fechaExplode[0])){//si ungresa un valor que no es fecha lo redireccionamos
            header('Location: /404');
        }

        //para usar la consulta SQL que es una consuta plana, debemos construir la consuta por ejemplo:
        $query = "SELECT citas.id, citas.hora, CONCAT( usuarios.nombre, ' ', usuarios.apellido) as cliente, ";
        $query .= " usuarios.email, usuarios.telefono, servicios.nombre as servicios, servicios.precio  ";
        $query .= " FROM citas  ";
        $query .= " LEFT OUTER JOIN usuarios ";
        $query .= " ON citas.usuarioId=usuarios.id  ";
        $query .= " LEFT OUTER JOIN citasServicios ";
        $query .= " ON citasServicios.citaId=citas.id ";
        $query .= " LEFT OUTER JOIN servicios ";
        $query .= " ON servicios.id=citasServicios.servicioId ";
        $query .= " WHERE fecha =  '${fecha}' ";

        $citas = AdminCitas::SQL($query);

        $alertas = AdminCitas::getAlertas();

        $router->render('admin/index', [
            'nombre'=> $_SESSION['nombre'],
            'citas' => $citas,
            'fecha' => $fecha,
            'alertas' => $alertas
        ]);
    }
}