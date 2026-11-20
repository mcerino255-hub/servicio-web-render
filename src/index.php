<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mi servidor web Docker</title>
    <style>
        body {
            font-family: Arial;
            background: #e9eef5;
            text-align: center;
            padding: 50px;
        }
        .contenedor {
            background: white;
            padding: 30px;
            border-radius: 12px;
            max-width: 600px;
            margin: auto;
        }
    </style>
</head>
<body>
    <div class="contenedor">
        <h1>Servidor Web con Docker</h1>
        <h2>Apache y PHP funcionando correctamente</h2>

        <?php
        echo "<p>PHP se está ejecutando correctamente.</p>";

        $host = getenv("MYSQL_HOST");
        $usuario = getenv("MYSQL_USER");
        $password = getenv("MYSQL_PASSWORD");
        $base_datos = getenv("MYSQL_DATABASE");
        $puerto = getenv("MYSQL_PORT") ?: 3306;

        $conexion = new mysqli(
            $host,
            $usuario,
            $password,
            $base_datos,
            (int)$puerto
        );

        if ($conexion->connect_error) {
            die("<p>No fue posible conectar con MySQL.</p>");
        }

        echo "<p>Conexión con MySQL establecida correctamente.</p>";

        $resultado = $conexion->query("SELECT DATABASE() AS nombre");

        if ($resultado) {
            $fila = $resultado->fetch_assoc();
            echo "<p>Base de datos: " .
                htmlspecialchars($fila['nombre']) . "</p>";
        }

        $conexion->close();
        ?>
    </div>
</body>
</html>
