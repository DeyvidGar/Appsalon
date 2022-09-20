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
            
            //validar si eliminamos cita de hoy
            $isToday = true;
            date_default_timezone_set('America/Mexico_City');
            $fecha = date('Y-m-d');
            if($fecha !== $cita->fecha){
                $isToday = false;
            }

            $resul = $cita->eliminar();

            if($resul){
                //validar si es el dia hoy / bug en redireccionamiento eliminar cita
                if($isToday){
                    header('Location: '. $_SERVER['HTTP_REFERER'] .'?cita-eliminada=1');
                } else {
                    header('Location: '. $_SERVER['HTTP_REFERER'] .'&cita-eliminada=1');

                }
            }
        }
    }
}