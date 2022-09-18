<?php

function debuguear($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// Escapa / Sanitizar el HTML
function sanitizar($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

//FUNCION QUE REVISA SI EL USUARIO ESTA AUTENTICADO
function isAuth() : void{
    //si no esta definida la siguiente variable de session lo redireccionamos a la ruta de iniciar session
    if (!isset($_SESSION['login'])) {
        header( 'Location: /');
    }
}

//validar si es admin si no lo es lo redireccionamos al login
function isAdmin() : void{
    // debuguear($_SESSION);
    if ($_SESSION['admin'] === '0' || !isset($_SESSION['admin'])) {
        header( 'Location: /cita');
    }
}

//comprobar si estamos en la ultima posicion del arreglo de servicios
function esUltimo($actual, $proximo) : bool{

    if($actual !== $proximo){
        return true;
    }

    return false;
}