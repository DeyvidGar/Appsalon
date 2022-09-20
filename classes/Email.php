<?php
namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email{

    public $nombre;
    public $email;
    public $token;

    public function __construct($nombre, $email, $token)
    {
        $this->nombre = $nombre;
        $this->email = $email;
        $this->token = $token;
    }

    public function enviarEmail(){

        $phpmailer = new PHPMailer();
        $phpmailer->isSMTP();
        $phpmailer->Host = 'smtp.mailtrap.io';
        $phpmailer->SMTPAuth = true;
        $phpmailer->Port = 2525;
        $phpmailer->Username = 'af5e08cc99afd6';
        $phpmailer->Password = 'e66c6ad6525a01';

        $phpmailer->setFrom('cuentas@appsalon.com');
        $phpmailer->addAddress('cuentas@appsalon.com', 'Appsalon.com');
        $phpmailer->Subject ='Confirma tu cuenta';

        $phpmailer->isHTML(TRUE);
        $phpmailer->CharSet = 'UTF-8';

        $contenido = "<html>";
        $contenido .= "<p><strong>Hola ".$this->nombre."</strong><p>";
        $contenido .= "<p>Has creado una cuenta en AppSalon, para confirmar tu registro presiona el siguiente enlace.</p>";
        $contenido .= "Presiona aquí: <a href='https://protected-garden-13147.herokuapp.com/confirmar-cuenta?token=$this->token'>Confirmar cuenta</a>";
        $contenido .= "<p>Si tu no has solictado este cambio puedes ignorar este mensaje.</p>";

        $phpmailer->Body = $contenido;

        $resultado = $phpmailer->send();

        return $resultado;
    }

    public function enviarInstrucciones(){

        $phpmailer = new PHPMailer();
        $phpmailer->isSMTP();
        $phpmailer->Host = 'smtp.mailtrap.io';
        $phpmailer->SMTPAuth = true;
        $phpmailer->Port = 2525;
        $phpmailer->Username = 'af5e08cc99afd6';
        $phpmailer->Password = 'e66c6ad6525a01';

        $phpmailer->setFrom('cuentas@appsalon.com');
        $phpmailer->addAddress('cuentas@appsalon.com', 'Appsalon.com');
        $phpmailer->Subject ='Reestablece tu password';

        $phpmailer->isHTML(TRUE);
        $phpmailer->CharSet = 'UTF-8';

        $contenido = "<html>";
        $contenido .= "<p><strong>Hola ".$this->nombre."</strong><p>";
        $contenido .= "<p>Has solicitado reestablecer tu password en AppSalon, para confirmar que lo has solicitado tú presiona el siguiente enlace.</p>";
        $contenido .= "<a href='https://protected-garden-13147.herokuapp.com/crear-nueva-password?token=$this->token'>Confirmar cuenta</a>";
        $contenido .= "<p>Si tu no has solictado este cambio puedes ignorar este mensaje.</p>";

        $phpmailer->Body = $contenido;

        $resultado = $phpmailer->send();

        return $resultado;
    }
}