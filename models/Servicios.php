<?php

namespace Model;

class Servicios extends ActiveRecord {

    protected static $tabla = 'servicios';
    protected static $columnasDB = ['id', 'precio', 'nombre'];

    public $id;
    public $precio;
    public $nombre;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->precio = $args['precio'] ?? '';
        $this->nombre = $args['nombre'] ?? '';
    }

    public function validarServicio(){
        if(!$this->nombre){
            self::$alertas['error'][] = 'El nombre del servicio es obligatorio';
        }

        if(!$this->precio){
            self::$alertas['error'][] = 'El precio es obligartorio';
        }
        if($this->precio && !is_numeric($this->precio)){
            self::$alertas['error'][] = 'El precio debe tener datos numericos';
        }

        return self::$alertas;
    }
}