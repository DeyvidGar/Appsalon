<?php

namespace Model;

class CitasServicios extends ActiveRecord{
    protected static $tabla = 'citasServicios';
    protected static $columnasDB = ['id', 'servicioId', 'citaId'];

    public $id;
    public $servicioId;
    public $citaId;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->servicioId = $args['servicioId'] ?? '';
        $this->citaId = $args['citaId'] ?? '';
    }
}