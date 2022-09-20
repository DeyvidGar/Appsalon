<?php

namespace Controllers;

use Model\Cita;
use Model\CitasServicios;
use Model\Servicios;

class APIController {
    public static function index(){
        $servicios = Servicios::all();
        echo json_encode($servicios);
    }

    public static function guardar(){

        $cita = new Cita($_POST);
        
        $resultado = $cita->guardar();

        $idCita = $resultado['id']; //despues de guardar la cita nos retorna un id dicho id

        // por cada coma un valor en un areglo
        $idServicios = explode(',', $_POST['servicioId']);

        foreach($idServicios as $idServicio){
            
            $args = [
                'servicioId' => $idServicio,
                'citaId' => $idCita
            ];

            $citaservicio = new CitasServicios($args);

            $citaservicio->guardar();
        }

        //mostramos la respuesta en consola o postman
        echo json_encode($resultado);
    }

    public static function eliminar(){
        
        $id = $_POST['id'];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $cita = Cita::find($id);

            $resul = $cita->eliminar();

            if($resul){
                //redireccionamiento a la direccion de la pagina anterior
                header('Location: '. $_SERVER['HTTP_REFERER'] .'&cita-eliminada=1');
            }
        }
    }
}