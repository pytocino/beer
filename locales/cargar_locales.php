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

    // Definir el número de resultados por página
    $resultadosPorPagina = 6;

    // Obtener el número de página actual de la URL
    $paginaActual = $_GET['pagina'];

    // Consulta SQL para contar el número total de resultados
    $countQuery = "SELECT COUNT(*) as total
            FROM locales L
            JOIN marcas_locales ML ON L.id_local = ML.id_local
            WHERE ML.nombre_marca = ?";

    $stmtCount = $conexion->prepare($countQuery);
    $stmtCount->bind_param("s", $marcaCerveza);
    $stmtCount->execute();
    $resultCount = $stmtCount->get_result();
    $rowCount = $resultCount->fetch_assoc();
    $totalResultados = $rowCount['total'];

    // Calcular el número total de páginas
    $totalPaginas = ceil($totalResultados / $resultadosPorPagina);

    // Calcular el desplazamiento para la consulta SQL
    $offset = ($paginaActual - 1) * $resultadosPorPagina;

    // Consulta SQL con limit y offset para la paginación
    $query = "SELECT L.*
            FROM locales L
            JOIN marcas_locales ML ON L.id_local = ML.id_local
            WHERE ML.nombre_marca = ?
            LIMIT ?, ?";

    $stmt = $conexion->prepare($query);
    $stmt->bind_param("sii", $marcaCerveza, $offset, $resultadosPorPagina);
    $stmt->execute();
    $result = $stmt->get_result();

    $valor1 = "";
    $valor2 = "";

    // Mostrar los resultados paginados
    if ($result->num_rows > 0) {
        $valor1 .= "<div class='col-12 text-center mt-5 mb-2'>
                    <h1><strong>" . ucwords($marcaCerveza) . "</strong></h1>
                </div>";
        while ($row = $result->fetch_assoc()) {
            $valor2 .= "<div class='col-12 col-md-6 mt-4 mb-3'>
                        <div class='card px-2 mb-2 pb-2 shadow text-center' style='width: 100%;'>
                            <h3 class='card-title mt-2'>" . ucwords($row['nombre']) . "</h3>
                            <p class='card-text'>" . ucwords($row['tipo_local']) . "</p>
                            <a class='btn btn-dark' href='" . $row['direccion'] . "'target='_blank'>Como llegar</a>
                        </div>
                    </div>";
        }
    }

    // Generar la paginación HTML
    $paginacionHTML = "<nav aria-label='paginacion cervezas'><ul class='pagination pagination-lg justify-content-center'>";
    for ($i = 1; $i <= $totalPaginas; $i++) {
        $paginacionHTML .= "<li class='page-item'><a class='page-link custom-pagination' href='?marcaCerveza=$marcaCerveza&pagina=$i'>$i</a></li>";
    }
    $paginacionHTML .= "</ul></nav>";

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
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6950924566762663"
     crossorigin="anonymous"></script>
</head>

<body class="fondo">
    <header class="container-fluid">
        <div class="row">
            <div class="col-12">
                <nav class="navbar navbar-expand justify-content-center my-4">
                    <a href="../index.php">
                        <img class="img-fluid" src="../images/beerfinder.svg" alt="logo beerfinder">
                    </a>
                </nav>
            </div>
        </div>
    </header>
    <main class="container">
        <div class="row">
            <?= $valor1; ?>
            <?= $valor2; ?>
            <div class='col-12 text-center mt-3'>
                <?= $paginacionHTML; ?>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-12">
                <button class="btn btn-dark" type="submit" id="coordenadasBoton">Mostrar en el mapa</button>
                <div class="mapa mt-4 mb-4" id="mapa" style="height:400px;"></div>
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