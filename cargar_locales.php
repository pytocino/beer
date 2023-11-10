<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BEER FINDER</title>
    <link rel="icon" href="./ico/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="/leaflet/leaflet.css" />
    <script src="/leaflet/leaflet.js"></script>

    <script src="script.js"></script>
</head>

<body>
    <header>
        <h1>BEER FINDER</h1>
    </header>
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
                echo "<h2>Locales que sirven " . ucwords($marcaCerveza) . ":</h2>";
                echo "<ul>";
                while ($row = $result->fetch_assoc()) {
                    echo "<section >
                            <div class='locales'>
                                <li>
                                    <h3>" . $row['nombre'] . "</h3><br><p>Tipo de local: " . ucwords($row['tipo_local']) . "</p><a href='" . $row['direccion'] . "'target='_blank'><button id='direccion'>Como llegar</button></a>
                                </li>
                            </div>
                        </section>";
                }
                echo "</ul>";
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

    </section>
    <section>
        <button type="submit" id="coordenadasBoton">Mostrar en el mapa</button>
    </section>
    <section class="centered-map">
        <div id="mapa" style="width: 800px; height: 400px;"></div>
    </section>
    <section>
        <div id="coordenadas"></div>
    </section>
</body>

</html>