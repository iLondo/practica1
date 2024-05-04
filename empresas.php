<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Empresas</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding: 20px;
        }
        h1 {
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #dee2e6;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f8f9fa;
        }
        .btn-container {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Gestión de Empresas</h1>
        
        <!-- Botón para ir al index -->
        <div class="btn-container">
            <a href="index.php" class="btn btn-primary">Inicio</a>
        </div>

        <!-- Botón para crear un nuevo registro -->
        <div class="btn-container">
            <a href="crear_empresa.php" class="btn btn-primary">Crear Empresa</a>
        </div>

        <!-- Botón para ver empleados por empresa -->
        <div class="btn-container">
            <a href="empleados_por_empresa.php" class="btn btn-primary">Ver empleados por empresa</a>
        </div>

        <!-- Tabla de empresas -->
        <table>
            <thead>
                <tr>
                    <th>NIT</th>
                    <th>Tipo de Empresa</th>
                    <th>Teléfono</th>
                    <th>Dirección</th>
                    <th>Email</th>
                    <th>Editar</th>
                    <th>Borrar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Incluir el archivo de conexión a la base de datos
                require_once 'conexion_bd.php';

                // Realizar la consulta a la tabla EMPRESA
                $sql = "SELECT * FROM EMPRESA";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["nit"] . "</td>";
                        echo "<td>" . $row["tipoEmpresa"] . "</td>";
                        echo "<td>" . $row["telefono"] . "</td>";
                        echo "<td>" . $row["direccion"] . "</td>";
                        echo "<td>" . $row["email"] . "</td>";
                        // Enlaces para editar y borrar
                        echo "<td><a href='editar_empresa.php?nit=" . $row["nit"] . "' class='btn btn-sm btn-primary'>Editar</a></td>";
                        echo "<td><a href='borrar_empresa.php?nit=" . $row["nit"] . "' class='btn btn-sm btn-danger' onclick='return confirm(\"¿Está seguro que desea eliminar esta empresa?\")'>Borrar</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No hay empresas registradas</td></tr>";
                }

                // Cerrar la conexión
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS (opcional, si necesitas funcionalidades como botones desplegables, modales, etc.) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
