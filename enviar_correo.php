<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $mensaje = $_POST['mensaje'];

    $para = 'pedrodavidg88@gmail.com';

    $titulo = 'Mensaje para BEERFINDER';
    $contenido = "Nombre: $nombre\nEmail: $email\nMensaje: $mensaje";

    $headers = "From: $email\r\nReply-To: $email\r\n";

    mail($para, $titulo, $contenido, $headers);
    header('Location: index.php');
    exit;
}
?>
