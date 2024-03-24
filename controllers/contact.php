<?php

require '../vendor/autoload.php'; // Ruta relativa para acceder al directorio vendor

function enviarCorreo($nombre, $email, $asunto, $mensaje) {
    $mail = new PHPMailer\PHPMailer\PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'teamstarteight@gmail.com';
        $mail->Password = 'hcpznfunkktgwbcz';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom($email, $nombre);
        $mail->addAddress($email); // Agregar la dirección de correo electrónico del remitente

        $mail->isHTML(true);
        $mail->Subject = $asunto;
        $mail->Body = '<html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Bienvenido</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    margin: 0;
                    padding: 0;
                    background-color: #f0f0f0;
                }
                .container {
                    max-width: 600px;
                    margin: 0 auto;
                    background-color: white;
                    border-radius: 10px;
                    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                }
                .header {
                    text-align: center;
                    padding: 20px;
                    background-color: #007bff;
                    color: white;
                }
                .content {
                    padding: 20px;
                }
                .button {
                    display: block;
                    width: 100%;
                    padding: 10px;
                    background-color: #007bff;
                    color: white;
                    text-align: center;
                    text-decoration: none;
                    border-radius: 5px;
                }
                .footer {
                    text-align: center;
                    padding: 20px;
                    font-size: 12px;
                    color: #888;
                }
            </style>
        </head>
        <body>
            <div class="container">
                <div class="header">
                    <h1>Bienvenido</h1>
                    <p>'. $nombre .', Gracias por contactarnos</p>
                </div>
                <div class="content">
                    <p>En breve le contestaremos a su consulta. Si lo desea, también puede obtener más información sobre lo que Teamstartereight.work puede hacer por usted.</p>
                    <a href="#" class="button">VISITA NUESTRA PÁGINA</a>
                </div>
                <div class="footer">
                    © 2024 Teamstartereight SAC. Todos los derechos reservados.
                </div>
            </div>
        </body>
        </html>';

        $mail->send();
        return true;
    } catch (Exception $e) {
        // Devuelve el mensaje de error
        return $mail->ErrorInfo;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $asunto = $_POST['asunto'];
    $mensaje = $_POST['mensaje'];

    $respuesta = array();

    $resultadoEnvio = enviarCorreo($nombre, $email, $asunto, $mensaje);

    if ($resultadoEnvio === true) {
        $respuesta['success'] = true;
        $respuesta['message'] = 'Mensaje enviado correctamente';
    } else {
        $respuesta['success'] = false;
        $respuesta['message'] = 'Error al enviar el mensaje: ' . $resultadoEnvio;
    }

    header('Content-Type: application/json');
    echo json_encode($respuesta);
}
