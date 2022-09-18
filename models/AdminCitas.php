<?php
namespace Model;

/**
 * CON ESTE MODELO UNIREMOS LAS TABLAS CON LA QUE ACCEDEMOS ALA CITA, SERVICIOS Y CLIENTE USANDO JOIN, UMPURTANTE DEFINIR LA CARDINALIDAD PARA UNA CONSULTA CLARA, NOTA: HACER ESTE TIPO DE CONSULTAS CONSUME MEMORIA Y CARGA AL SERVIDOR
 * 
 */

class AdminCitas extends ActiveRecord{
    //Tabla que tiene mas datos por consultar
    protected static $tabla = 'citasServicios';
    protected static $columnasDB = ['id', 'hora','cliente','email','telefono','servicios','precio'];

    public $id;
    public $hora;
    public $cliente;
    public $email;
    public $telefono;
    public $servicios;
    public $precio;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;       
        $this->id = $args['hora'] ?? '';           
        $this->id = $args['cliente'] ?? '';           
        $this->id = $args['email'] ?? '';           
        $this->id = $args['telefono'] ?? '';           
        $this->id = $args['servicios'] ?? '';           
        $this->id = $args['precio'] ?? '';           
    }
}
