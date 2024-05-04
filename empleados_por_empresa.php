<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Empleados por Empresa</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding: 20px;
        }
        h1 {
            margin-bottom: 20px;
            text-align: center;
        }
        form {
            max-width: 400px;
            margin: 0 auto;
        }
        label {
            margin-bottom: 5px;
            display: block;
        }
        input[type="submit"] {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Ver Empleados por Empresa</h1>
        <form action="empleados_por_empresa.php" method="GET">
            <div class="form-group">
                <label for="empresa">Selecciona una empresa:</label>
                <select class="form-control" id="empresa" name="nit">
                    <?php
                    // Incluir el archivo de conexión a la base de datos
                    require_once 'conexion_bd.php';

                    // Consultar todas las empresas
                    $sql = "SELECT nit, nombre FROM EMPRESA";
                    $result = $conn->query($sql);

                    if ($result && $result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row["nit"] . "'>" . $row["nombre"] . "</option>";
                        }
                    } else {
                        echo "<option value=''>No hay empresas disponibles</option>";
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Ver Empleados</button>
        </form>

        <?php
        // Si se ha recibido el parámetro 'nit' y es válido
        if(isset($_GET['nit']) && !empty($_GET['nit'])) {
            $nit = $_GET['nit'];

            // Consultar los empleados asociados a la empresa seleccionada
            $sql = "SELECT * FROM EMPLEADO WHERE nitEmpresa = '$nit'";
            $result = $conn->query($sql);

            if ($result && $result->num_rows > 0) {
                echo "<h2>Empleados de la empresa seleccionada</h2>";
                echo "<table class='table'>
                        <thead>
                            <tr>
                                <th>Número de ID</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Cargo</th>
                                <th>Teléfono</th>
                                <th>Correo Electrónico</th>
                            </tr>
                        </thead>
                        <tbody>";
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row["numeroID"] . "</td>
                            <td>" . $row["nombres"] . "</td>
                            <td>" . $row["apellidos"] . "</td>
                            <td>" . $row["cargo"] . "</td>
                            <td>" . $row["telefono"] . "</td>
                            <td>" . $row["email"] . "</td>
                        </tr>";
                }
                echo "</tbody></table>";
            } else {
                echo "<p>No hay empleados registrados para esta empresa.</p>";
            }
        }
        ?>
        <div class="btn-container">
            <a href="empresas.php" class="btn btn-primary">Volver a empresas</a>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
