<?php

require '../vendor/autoload.php'; // Ruta relativa para acceder al directorio vendor

function enviarCorreo($nombre, $email, $mensaje) {
    $mail = new PHPMailer\PHPMailer\PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'teamstarteight@gmail.com';
        $mail->Password = 'cxpzorvpykovqoci';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom($email, $nombre);
        $mail->addAddress('support@teamstarteight.work');

        $mail->isHTML(true);
        $mail->Subject = 'Nuevo mensaje de contacto';
        $mail->Body = 'Nombre: ' . $nombre . '<br>Email: ' . $email . '<br>Mensaje: ' . $mensaje;

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $mensaje = $_POST['mensaje'];

    $respuesta = array();

    if (enviarCorreo($nombre, $email, $mensaje)) {
        $respuesta['success'] = true;
        $respuesta['message'] = 'Mensaje enviado correctamente';
    } else {
        $respuesta['success'] = false;
        $respuesta['message'] = 'Error al enviar el mensaje';
    }

    header('Content-Type: application/json');
    echo json_encode($respuesta);
}
