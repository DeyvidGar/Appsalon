<?php 
require __DIR__ . '/../vendor/autoload.php';

//leer las varialbes de entorno
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeload();

require 'funciones.php';

//importamos credenciales y conexion a la base de datos
require 'database.php';

// Conectarnos a la base de datos
use Model\ActiveRecord;
ActiveRecord::setDB($db);