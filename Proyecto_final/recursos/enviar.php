<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


require 'C:\xampp\htdocs\TAREA\Proyecto_final\PHPMailer-master\PHPMailer-master\src\Exception.php';
require 'C:\xampp\htdocs\TAREA\Proyecto_final\PHPMailer-master\PHPMailer-master\src\PHPMailer.php';
require 'C:\xampp\htdocs\TAREA\Proyecto_final\PHPMailer-master\PHPMailer-master\src\SMTP.php';

$config = array(
    'smtpHost' => 'smtp.gmail.com',
    'smtpPort' => 587,
    'smtpUsername' => 'victorsanchezmontalvan@gmail.com',
    'smtpPassword' => 'elosycnzzmbmpssw',
    'smtpEncryption' => 'tls',
    'fromEmail' => $_POST['correo'],
    'fromName' => 'eBookLand',
    'toEmail' => 'ati76166481@istrfa.edu.pe'
);

function enviarCorreo($destinatario, $asunto, $cuerpo, $remite) {
    global $config;

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = $config['smtpHost'];
        $mail->SMTPAuth   = true;
        $mail->Username   = $config['smtpUsername'];
        $mail->Password   = $config['smtpPassword'];
        $mail->SMTPSecure = $config['smtpEncryption'];
        $mail->Port       = $config['smtpPort'];

        $mail->setFrom($config['fromEmail'], $config['fromName']);
        $mail->addAddress($destinatario);
        $mail->addReplyTo($remite);
        $mail->Subject = $asunto;
        $mail->Body    = $cuerpo;

        $mail->send();
        return true;
    } catch (Exception $e) {
        return "Error al enviar el correo electrónico: {$e->getMessage()}";
    }
}

// Procesar el formulario si se ha enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar que los campos requeridos estén presentes
    if (isset($_POST['nombre'], $_POST['correo'], $_POST['telf'], $_POST['message'])) {
        $destinatario = 'ati76166481@istrfa.edu.pe';
        $asunto = 'Nuevo mensaje de contacto';
        $cuerpo = "Nombre: {$_POST['nombre']}\nCorreo Electrónico: {$_POST['correo']}\nTeléfono: {$_POST['telf']}\nMensaje: {$_POST['message']}";

        $resultado = enviarCorreo($destinatario, $asunto, $cuerpo, $_POST['correo']);

        if ($resultado === true) {
            echo 'Correo electrónico enviado exitosamente.';
        } else {
            echo $resultado;
        }
    } else {
        echo 'Todos los campos del formulario son requeridos.';
    }
}
?>
