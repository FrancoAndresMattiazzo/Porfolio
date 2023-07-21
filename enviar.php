<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Reemplaza 'tu_correo@tudominio.com' con la dirección de correo electrónico a la que quieres recibir el mensaje.
    $para = 'contact@francom.dev';
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $asunto = $_POST['motivo'];
    $mensaje = $_POST['contenido'];

    $cabeceras = "From: $nombre <$email>" . "\r\n" .
        "Reply-To: $email" . "\r\n" .
        "X-Mailer: PHP/" . phpversion();

    // Envía el correo electrónico
    if (mail($para, $asunto, $mensaje, $cabeceras)) {
        echo '<script>alert("Correo enviado correctamente.");</script>';
    } else {
        echo '<script>alert("Error al enviar el correo. Por favor, inténtalo de nuevo más tarde.");</script>';
    }
}
?>