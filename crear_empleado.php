<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Nuevo Empleado</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding: 20px;
        }
        h1 {
            margin-bottom: 20px;
        }
        form {
            max-width: 400px;
            margin: 0 auto;
        }
        label {
            margin-bottom: 5px;
            display: block;
        }
        input[type="text"],
        input[type="email"],
        input[type="submit"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .error-message {
            color: red;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Crear Nuevo Empleado</h1>
        
        <form action="crear_empleado.php" method="post">
            <label for="numeroID">Número de ID:</label>
            <input type="text" id="numeroID" name="numeroID" required>
            
            <label for="tipoID">Tipo de ID:</label>
            <input type="text" id="tipoID" name="tipoID" required>
            
            <label for="nombres">Nombres:</label>
            <input type="text" id="nombres" name="nombres" required>
            
            <label for="apellidos">Apellidos:</label>
            <input type="text" id="apellidos" name="apellidos" required>
            
            <label for="telefono">Teléfono:</label>
            <input type="text" id="telefono" name="telefono" required>
            
            <label for="direccion">Dirección:</label>
            <input type="text" id="direccion" name="direccion" required>
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            
            <label for="nitEmpresa">NIT Empresa:</label>
            <input type="text" id="nitEmpresa" name="nitEmpresa" required>
            
            <label for="cargo">Cargo:</label>
            <input type="text" id="cargo" name="cargo" required>
            
            <label for="salario">Salario:</label>
            <input type="text" id="salario" name="salario" required>
            
            <input type="submit" value="Crear Empleado">
        </form>

        <div class="btn-container">
            <a href="empleados.php" class="btn btn-primary">Volver a empleados</a>
        </div>

        <?php

        require_once 'conexion_bd.php';

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $numeroID = mysqli_real_escape_string($conn, $_POST['numeroID']);
            $tipoID = mysqli_real_escape_string($conn, $_POST['tipoID']);
            $nombres = mysqli_real_escape_string($conn, $_POST['nombres']);
            $apellidos = mysqli_real_escape_string($conn, $_POST['apellidos']);
            $telefono = mysqli_real_escape_string($conn, $_POST['telefono']);
            $direccion = mysqli_real_escape_string($conn, $_POST['direccion']);
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $nitEmpresa = mysqli_real_escape_string($conn, $_POST['nitEmpresa']);
            $cargo = mysqli_real_escape_string($conn, $_POST['cargo']);
            $salario = mysqli_real_escape_string($conn, $_POST['salario']);

            $sql = "INSERT INTO EMPLEADO (numeroID, tipoID, nombres, apellidos, telefono, direccion, email, nitEmpresa, cargo, salario) VALUES ('$numeroID', '$tipoID', '$nombres', '$apellidos', '$telefono', '$direccion', '$email', '$nitEmpresa', '$cargo', '$salario')";

            if ($conn->query($sql) === TRUE) {
                echo "<p>Nuevo empleado creado correctamente</p>";
            } else {
                echo "<p class='error-message'>Error al crear el nuevo empleado: " . $conn->error . "</p>";
            }
        }

        $conn->close();
        ?>
    </div>
</body>
</html>
