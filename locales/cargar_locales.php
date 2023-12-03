<!DOCTYPE html>
<html lang="en">

<?php
// Recopila la marca de cerveza del formulario
if (isset($_GET['marcaCerveza'])) {
    $marcaCerveza = strtolower($_GET['marcaCerveza']);

    // Realiza una conexión a la base de datos (reemplaza con tus propias credenciales)
    $conexion = new mysqli("localhost", "super", "123456", "beerfinder");

    // Verifica la conexión
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    // Realiza una consulta SQL para buscar locales que sirvan la marca de cerveza
    $query = "SELECT L.*
            FROM locales L
            JOIN marcas_locales ML ON L.id_local = ML.id_local
            WHERE ML.nombre_marca = ?";

    // Utiliza una declaración preparada para evitar la inyección de SQL
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("s", $marcaCerveza);
    $stmt->execute();
    $result = $stmt->get_result();

    $valor1 = "";
    $valor2 = "";

    // Mostrar los resultados
    if ($result->num_rows > 0) {
        $valor1 .= "<div class='col-12 text-center mt-5 mb-2'>
                        <h1><strong>" . ucwords($marcaCerveza) . "</strong></h1>
                    </div>";
        while ($row = $result->fetch_assoc()) {
            $valor2 .= "<div class='col-12 col-md-6 mt-4 mb-3'>
                            <div class='card px-2 mb-2 pb-2 shadow text-center' style='width: 100%;'>
                                <h3 class='card-title mt-2'>" . ucwords($row['nombre']) . "</h3>
                                <p class='card-text'>Tipo de local: " . ucwords($row['tipo_local']) . "</p>
                                <a class='btn btn-dark' href='" . $row['direccion'] . "'target='_blank'>Como llegar</a>
                            </div>
                        </div>";
        }
    }

    $query2 = "SELECT L.*
            FROM locales L
            JOIN marcas_locales ML ON L.id_local = ML.id_local
            WHERE ML.nombre_marca = ?";

    // Utiliza una declaración preparada para evitar la inyección de SQL
    $stmt2 = $conexion->prepare($query2);
    $stmt2->bind_param("s", $marcaCerveza);
    $stmt2->execute();
    $result2 = $stmt2->get_result();

    // Crear un array para almacenar los datos de latitud y longitud
    $locales = [];

    // Almacenar los resultados en el array
    if ($result2->num_rows > 0) {
        while ($row = $result2->fetch_assoc()) {
            $locales[] = $row;
        }
    }
    $localescod = json_encode($locales);
?>
    <script>
        let locales = <?= $localescod; ?>;
    </script>
<?php
    // Cierra la conexión a la base de datos
    $stmt->close();
    $conexion->close();
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BEERFINDER</title>
    <link rel="icon" type="image/png" href="../ico/favicon-16x16.png">
    <link rel="icon" type="image/png" href="../ico/favicon-32x32.png">
    <meta name="description" content="Encuentra fácilmente bares y restaurantes que sirven la cerveza que más te gusta con BeerFinder. ¡Busca una cerveza y descubre donde la sirven!">
    <meta name="description" content="¿Donde tomarme una <?= $valor2; ?>? ">
    <meta name="keywords" content="BeerFinder, localizador de cervezas, bares de cerveza, restaurantes con cerveza, locales con cerveza">
    <meta name="robots" content="index, follow">
    <link rel="icon" href="../ico/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../bootstrap-5.3.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/custom.css">
    <link rel="stylesheet" href="../leaflet/leaflet.css" />
    <script src="../leaflet/leaflet.js"></script>
    <script src="../js/script.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Georama:ital,wght@1,500&display=swap" rel="stylesheet">
</head>

<body>
<header class="container-fluid">
        <div class="row">
            <div class="col-12">
                <nav class="navbar navbar-expand justify-content-center my-4 px-3">
                    <a href="index.php">
                        <img class="img-fluid" src="../images/beerfinder.svg" alt="logo beerfinder">
                    </a>
                </nav>
            </div>
        </div>
    </header>
    <main class="container fondo px-4">
        <div class="row">
            <?= $valor1; ?>
            <?= $valor2; ?>
        </div>
        <div class="row mt-4">
            <div class="col-12">
                <button class="btn btn-dark" type="submit" id="coordenadasBoton">Mostrar en el mapa</button>
                <div class="mapa mt-4 mb-4" id="mapa"></div>
            </div>
        </div>
    </main>
    <footer class="container-fluid mt-5">
        <div class="row">
            <div class="col-12 bg-black">
                <div class="text-center text-white py-4">
                    <h3>© 2023 BEERFINDER<br>Todos los derechos reservados.</h3>
                </div>
            </div>
        </div>
    </footer>
    <script src="../bootstrap-5.3.2-dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>