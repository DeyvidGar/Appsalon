<?php

namespace Model;

class CitasServicios extends ActiveRecord{
    protected static $tabla = 'citasservicios';
    protected static $columnasDB = ['id', 'serviciosId', 'citasId'];

    public $id;
    public $serviciosId;
    public $citasId;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->serviciosId = $args['serviciosId'] ?? '';
        $this->citasId = $args['citasId'] ?? '';
    }
}