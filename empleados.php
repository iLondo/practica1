<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Empleados</title>
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
        <h1>Gestión de Empleados</h1>
        
        <div class="btn-container">
            <a href="crear_empleado.php" class="btn btn-primary">Crear Empleado</a>
        </div>

        <div class="btn-container">
            <a href="index.php" class="btn btn-primary">Volver al inicio</a>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Número de ID</th>
                    <th>Tipo de ID</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Teléfono</th>
                    <th>Dirección</th>
                    <th>Email</th>
                    <th>NIT Empresa</th>
                    <th>Cargo</th>
                    <th>Salario</th>
                    <th>Editar</th>
                    <th>Borrar</th>
                </tr>
            </thead>
            <tbody>
                <?php
             
                require_once 'conexion_bd.php';

                $sql = "SELECT * FROM EMPLEADO";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["numeroID"] . "</td>";
                        echo "<td>" . $row["tipoID"] . "</td>";
                        echo "<td>" . $row["nombres"] . "</td>";
                        echo "<td>" . $row["apellidos"] . "</td>";
                        echo "<td>" . $row["telefono"] . "</td>";
                        echo "<td>" . $row["direccion"] . "</td>";
                        echo "<td>" . $row["email"] . "</td>";
                        echo "<td>" . $row["nitEmpresa"] . "</td>";
                        echo "<td>" . $row["cargo"] . "</td>";
                        echo "<td>" . $row["salario"] . "</td>";
                        
                        echo "<td><a href='editar_empleado.php?numeroID=" . $row["numeroID"] . "' class='btn btn-sm btn-primary'>Editar</a></td>";
                        echo "<td><a href='borrar_empleado.php?numeroID=" . $row["numeroID"] . "' class='btn btn-sm btn-danger' onclick='return confirm(\"¿Está seguro que desea eliminar este empleado?\")'>Borrar</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='12'>No hay empleados registrados</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
