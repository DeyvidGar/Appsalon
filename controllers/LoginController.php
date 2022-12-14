<?php
namespace Controllers;

use Classes\Email;
use Model\Usuario;
use MVC\Router;

class LoginController {
    public static function login( Router $router ){

        $email = '';
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $auth = new Usuario($_POST);
            $email = $auth->email;

            $alertas = $auth->validarLogin();
            
            if(empty($alertas)){
                $usuario = $auth->where('email', $email);
                
                if($usuario){
                    //validar pass y usuario verificado en la bd
                    $resultado = $usuario->comporbarPasswordAndVerificado($auth->password);

                    if($resultado){
                        $usuario->login();
                    }

                } else{
                    Usuario::setAlerta('error', 'Usuario no esta registrado.');
                }

                $alertas = Usuario::getAlertas();
            }
        }

        $router -> render('auth/login', [
            'email' => $email,
            'alertas' => $alertas    
        ]);
    }

    public static function logout(){
        $_SESSION = [];

        header('Location: /');
    }

    public static function olvide_password( Router $router){
        
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $email = new Usuario($_POST);

            if(!$email->email){
                Usuario::setAlerta('error', 'Debes ingresar un Email');
            } else {
                $usuario = $email->where('email', $email->email);

                if($usuario && $usuario->confirmado === '1'){
                    $usuario->crearToken();

                    $usuario->guardar();

                    $email = new Email($usuario->nombre, $usuario->email, $usuario->token);

                    $email->enviarInstrucciones();

                    $alertas = Usuario::setAlerta('exito', 'Revisa tu email y sigue las indicacion para continuar');
                } else {
                    $alertas = Usuario::setAlerta('error', 'Este correo no esta registrado o no ha confirmado su cuenta');
                }   
            }
        }

        $alertas = Usuario::getAlertas();
        
        $router->render('auth/olvide-password', [
            'alertas' => $alertas
        ]);
    }

    public static function crear_nueva_password( Router $router){

        $error = false;
        $alertas = [];
        $token = $_GET['token'] ?? null;
        $usuario = Usuario::where('token', $token);
        
        if(!$token || empty($usuario)){
            $alertas = Usuario::setAlerta('error', 'No existe token');
            $error = true;
        } 
        
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $password = new Usuario($_POST);

            $alertas = $password->validarPassword();

            if(empty($alertas)){
                $usuario->password = $password->password;
                $usuario->hashPassword();
                $usuario->token = '';
                $resultado = $usuario->guardar();
                if($resultado){
                    header('Location: /');
                } else{
                    $alerta = Usuario::setAlerta('error', 'Algo salio mal intentelo mas tarde.');
                }
            }
        }

        $alertas = Usuario::getAlertas();

        $router->render('auth/crear-nueva-password', [
            'alertas' => $alertas,
            'error' => $error
        ]);
    }

    public static function registrar_nueva_cuenta( Router $router){

        $usuario = new Usuario;

        $alertas = $usuario::getAlertas();

        if($_SERVER["REQUEST_METHOD"] === 'POST'){

            $usuario->sincronizar($_POST);

            $alertas = $usuario->validarNuevaCuenta();

            if(empty($alertas)){
                $resultado = $usuario -> findUsuario();

                if($resultado){
                    //si el usuario existe
                    $alertas = Usuario::getAlertas();
                } else {
                    //no esta registrado - guardar registro

                    $usuario->hashPassword();

                    $usuario->crearToken();

                    //clase para enviar email con phpmailer
                    $email = new Email($usuario->nombre, $usuario->email, $usuario->token);

                    $resultadoEmail = $email->enviarEmail();
                    
                    if(!$resultadoEmail){
                        Usuario::setAlerta('error', 'El correo electronico no se pudo enviar');
                    } else {
                        $resultado = $usuario->guardar();
                        
                        if($resultado['resultado']){
                            header('Location: /mensaje');
                        } else {
                            Usuario::setAlerta('error', 'Algo salio mal, vuelve a intentarlo');
                        }
                    }
                    $alertas = Usuario::getAlertas();
                }
            }
        }

        $router->render('auth/registrar-nueva-cuenta', [
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }

    public static function confirmar_cuenta( Router $router ){

        $alertas = [];

        $token = sanitizar($_GET['token']);

        $usuario = Usuario::where('token', $token);

        if(is_null($usuario)){
            Usuario::setAlerta('error', 'Token no valido');
        } else{
            //autenticar usuario
            $usuario->confirmado = 1;
            $usuario->token = '';

            //actualziar datos del usuario
            $resultado = $usuario->guardar();

            if(!$resultado){
                Usuario::setAlerta('error', 'Algo salio mal, vuelve a intentarlo.');
            }

            Usuario::setAlerta('exito', "Tu cuenta ha sido registrada con exito ahora puedes <a href='http://localhost:3000/'>iniciar secion</a>.");
        }

        $alertas = Usuario::getAlertas();

        $router->render('auth/confirmar-cuenta', [
            'alertas' => $alertas
        ]);
    }

    public static function mensaje( Router $router ){
        $router->render('auth/mensaje');
    }
}