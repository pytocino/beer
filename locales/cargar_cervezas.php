<!DOCTYPE html>
<html lang="en">

<?php
if (isset($_GET['locales'])) {
    $locales = strtolower($_GET['locales']);

    $conexion = new mysqli("localhost", "super", "123456", "beerfinder");

    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    $query = "SELECT L.nombre AS nombre_local, ML.nombre_marca
    FROM locales L
    JOIN marcas_locales ML ON L.id_local = ML.id_local
    WHERE L.nombre = ?";

    $stmt = $conexion->prepare($query);
    $stmt->bind_param("s", $locales);
    $stmt->execute();
    $result = $stmt->get_result();

    $valor1 = "";
    $valor2 = "";

    if ($result->num_rows > 0) {
        $valor1 .= "<div class='col-12 text-center mt-5 mb-2'>
                        <h1>En " . ucwords($locales) . " sirven</h1>
                    </div>";
        while ($row = $result->fetch_assoc()) {
            $valor2 .= "<div class='col-12 col-md-6 mt-4 mb-3'>
                            <div class='card px-2 mb-2 pb-2 shadow text-center' style='width: 100%;'>
                                <h3 class='card-title mt-2'>" . ucwords($row['nombre_marca']) . "</h3>
                            </div>
                        </div>";
        }
    }

    $stmt->close();
    $conexion->close();
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BEERFINDER</title>
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
    <header class="d-flex justify-content-center">
        <div class="row">
            <nav class="navbar navbar-expand-sm m-4">
                <a href="../index.php">
                    <img class="logo img-fluid mx-auto d-block" src="../images/beerfinder.png" alt="logo beerfinder">
                </a>
            </nav>
        </div>
    </header>
    <main class="fondo px-4">
        <div class="row">
            <?= $valor1; ?>
            <?= $valor2; ?>
        </div>
    </main>
    <footer class="bg-black text-white text-center py-3">
        <h3>© 2023 BeerFinder.<br>Todos los derechos reservados.</h3>
    </footer>
    <script src="../bootstrap-5.3.2-dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>