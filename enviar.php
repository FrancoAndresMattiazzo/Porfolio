<?php
require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

echo '<style>body { background-color: black; }</style>';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $para = 'contact@francom.dev';
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $asunto = $_POST['motivo'];
    $mensaje = $_POST['contenido'];

    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->Host = 'smtp.ionos.es';
    $mail->Port = 587;
    $mail->SMTPAuth = true;
    $mail->Username = 'contact@francom.dev';
    $mail->Password = 'nuxbys-dupre1-cahNob';

    $mail->SetFrom($email, $nombre);
    $mail->AddAddress($para);
    $mail->Subject = $asunto;
    $mail->Body = $mensaje;

    // Intentar enviar el correo
    if ($mail->Send()) {
        // Mostrar SweetAlert de éxito después de que el DOM haya cargado
        echo "
        <script src='https://unpkg.com/sweetalert/dist/sweetalert.min.js'></script>
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            swal({
                title: '¡Correo enviado!',
                text: 'El correo fue enviado correctamente.',
                icon: 'success',
                buttons: {
                    confirm: {
                        text: 'OK',
                        value: true,
                        visible: true,
                        className: 'btn btn-success',
                        closeModal: true
                    }
                }
            }).then(function() {
                window.location.href = 'index.php';
            });
        });
        </script>";
    } else {
        // Mostrar SweetAlert de error después de que el DOM haya cargado
        echo "
        <script src='https://unpkg.com/sweetalert/dist/sweetalert.min.js'></script>
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            swal({
                title: '¡Error!',
                text: 'Error al enviar el correo. Por favor, inténtalo de nuevo más tarde.',
                icon: 'error',
                buttons: {
                    confirm: {
                        text: 'OK',
                        value: true,
                        visible: true,
                        className: 'btn btn-danger',
                        closeModal: true
                    }
                }
            }).then(function() {
                window.location.href = 'index.php';
            });
        });
        </script>";
    }

}
?>
