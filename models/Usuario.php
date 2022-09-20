<?php

namespace Model;

class Usuario extends ActiveRecord{

    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'nombre' , 'apellido' , 'telefono' , 'password' , 'email' , 'confirmado' , 'token' , 'admin' ];

    public $nombre;
    public $apellido;
    public $telefono;
    public $email;
    public $password;
    public $admin;
    public $token;
    public $confirmado;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->admin = $args['admin'] ?? 0;
        $this->token = $args['token'] ?? '';
        $this->confirmado = $args['confirmado'] ?? 0;
    }

    public function validarLogin(){
        if(!$this->email){
            self::$alertas['error'][] = 'Debes ingresar un correo electronico';
        }
        if(!$this->password){
            self::$alertas['error'][] = 'Ingresa la contraseña';
        }

        return self::$alertas;
    }

    public function validarNuevaCuenta(){
        if(!$this->nombre){
            self::$alertas['error'][] = 'El nombre es obligatorio';
        }

        if(!$this->apellido){
            self::$alertas['error'][] = 'El apellido es obligatorio';
        }

        if(!$this->telefono){
            self::$alertas['error'][] = 'El telefono es obligatorio';
        }

        if(!$this->email){
            self::$alertas['error'][] = 'Escribe tu correo electronico';
        }

        if(!$this->password){
            self::$alertas['error'][] = 'Debes escribir una contraseña';
        }
        if($this->password){
            if(strlen($this->password) < 6){
                self::$alertas['error'][] = 'El password debe contener almenos 6 caracteres';
            }
        }

        return self::$alertas;
    }

    public function validarPassword(){
        if(!$this->password){
            self::$alertas['error'][]= 'El password es obligatorio';
        }
        if($this->password && (strlen($this->password) < 6)){
            self::$alertas['error'][] = 'El password debe tener almenos 6 caracteres';
        }

        return self::$alertas;
    }

    public function findUsuario(){
        $query = "SELECT * FROM ". self::$tabla ." WHERE email LIKE '%". $this->email."%' LIMIT 1";

        $resultado = self::consultarSQL($query);

        if($resultado){
            self::$alertas['error'][] = 'Este correo ya esta registrado';
        }

        return array_shift($resultado);

    }

    public function hashPassword(){
        //hash password (60 caracteres)
        $passwordHash = password_hash($this->password, PASSWORD_DEFAULT);
        $this->password = $passwordHash;
    }

    public function crearToken(){
        $this->token = uniqid();
    }

    public function comporbarPasswordAndVerificado($password){

        $validar = password_verify($password,$this->password);
        $confirmado = $this->confirmado ?? '';
                
        if(!$confirmado || !$validar){
            self::$alertas['error'][] = 'Este usuario no ha confirmado su registro o la contraseña es incorrecta.';
        } else{
            return true;
        }
    }

    public function login(){
        
        if(!isset($_SESSION)) {
            session_start();
        };

        $_SESSION['login'] = true;

        //almacenamos todos los atributos del objeto en las variables de session
        foreach($this as $key => $value){
            if($key === 'password')continue; //ignoramos la columna de admin         
            $_SESSION[$key] = $value;
        }

        if($this->admin === '1'){
            header('Location: /admin');
        } else{
            header('Location: /cita');
        }
    }
}