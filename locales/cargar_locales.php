<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BEERFINDER</title>
    <link rel="icon" href="/ico/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../css/style2.css">
    <link rel="stylesheet" href="/leaflet/leaflet.css" />
    <script src="/leaflet/leaflet.js"></script>
    <script src="/js/script.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Georama:ital,wght@1,500&display=swap" rel="stylesheet">
</head>

<body>
    <header>
        <div id="header">
            <a href="../index.html">
                <img src="/images/beerfinder.png" alt="logo" width="200px">
            </a>
        </div>
    </header>
    <div id="main">
        <section>
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

                // Mostrar los resultados
                if ($result->num_rows > 0) {
                    echo "  <div id='marca'>
                                <h2>Locales que sirven " . ucwords($marcaCerveza) . ":</h2>
                            </div>";
                    echo "<div id ='marcaLocales'><ul>";
                    while ($row = $result->fetch_assoc()) {
                        echo "  <li id='listado'>
                                    <h3>" . $row['nombre'] . "</h3>
                                    <p>Tipo de local: " . ucwords($row['tipo_local']) . "</p>
                                    <a class='boton' href='" . $row['direccion'] . "'target='_blank'>Como llegar</a>
                                </li>";
                    }
                    echo "</ul></div>";
                } else {
                    echo "<p>No se encontraron locales que sirvan $marcaCerveza.</p>";
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
            } else {
                echo "No se proporcionó una marca de cerveza válida.";
            }
            ?>
            <div id="mostrarMapa">
                <div>
                    <button type="submit" id="coordenadasBoton">Mostrar en el mapa</button>
                </div>
                <div id="mapa"></div>
            </div>
        </section>
    </div>
    <footer>
        <h3>© 2023 BeerFinder.<br>Todos los derechos reservados.</h3>
    </footer>
</body>

</html>