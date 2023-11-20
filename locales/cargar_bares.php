<?php
$conn = new mysqli("localhost", "super", "123456", "beerfinder");

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Nombre del archivo de texto
$archivo = './bares';

// Abrir el archivo y leer los nombres
$nombres = file($archivo, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

// Insertar nombres en la base de datos
foreach ($nombres as $nombre) {
    $nombre = trim($nombre); // Eliminar espacios en blanco adicionales
    if (!empty($nombre)) {
        $sql = "INSERT INTO marcas_cerveza (nombre) VALUE ('$nombre')";
        if ($conn->query($sql) === FALSE) {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

// Cerrar la conexión
$conn->close();
