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

        //Almacenamos la cita y devuelve el id
        //instanciamos un nuevo modelo de citas con los datos de post que se envian desde el fetch de js
        $cita = new Cita($_POST);

        //verificar que el usuario sea el mismo que realiza la consulta
        // if($cita->usuarioId === $_SESSION['id']){
            $resultado = $cita->guardar();
        // } else{
        //     $resultado = null;
        // }

        //Almacena la cita y el servicio
        $idCita = $resultado['id']; //despues de guardar la cita nos retorna un id dicho id lo almacenamos en la variable idcita

        //debemos extraer los sercicios quese obtiene en el post, y estos servicios se encuentran en un string separados por comas 
        //todo: convertir los servicios que se encuentran en string en un arreglo con con un valor por cada servicio e iterar en dicho arreglo de los servicios y guardar cada uno de los sercixios que se seleccionen
        $idServicios = explode(',', $_POST['servicioId']);
        //en php con explode podemos separar un string en un arreglo en este caso cada separacion COMA separa el valor del arraglo

        foreach($idServicios as $idServicio){
            //creamos el arreglo asociativo que tiene que recibir el objeto de citasservicios y le asignamos sus respectivos valores en sus atributos
            $args = [
                'servicioId' => $idServicio,
                'citaId' => $idCita
            ];
            //instanciamos el objeto con los argumentos creaodos
            $citaservicio = new CitasServicios($args);

            $citaservicio->guardar();
        }

        // $resultado = [
        //     'cita' => $cita->usuarioId
        // ];
        // $resultado = [
        //     'cita' => $_SESSION['id'] //la sv de post lee los valores de body en el fetch de js
        // ];

        //mostramos la respuesta en consola o postman
        echo json_encode($resultado);//podemos ver el resultado por medio de postman. por ejemplo el de guardar: {"resultado":true,"id":1}
    }

    public static function eliminar(){
        
        $id = $_POST['id'];
        // debuguear($_SERVER);
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $cita = Cita::find($id);

            $resul = $cita->eliminar();

            if($resul){
                header('Location: '. $_SERVER['HTTP_REFERER'] .'&cita-eliminada=1');//CON ESTA SUPER VARIABLE PODEMOS SABER CUAL FUE LA ULTIMA RUTA QUE VISITO
            }
            // debuguear($_SERVER);
        }
    }
}