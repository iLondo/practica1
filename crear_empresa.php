<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Nueva Empresa</title>
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
        <h1>Crear Nueva Empresa</h1>
        
        <form action="crear_empresa.php" method="post">
            <label for="nit">NIT:</label>
            <input type="text" id="nit" name="nit" required>
            
            <label for="nombre">Nombre de la Empresa:</label>
            <input type="text" id="nombre" name="nombre" required>
            
            <label for="tipoEmpresa">Tipo de Empresa:</label>
            <input type="text" id="tipoEmpresa" name="tipoEmpresa" required>
            
            <label for="telefono">Teléfono:</label>
            <input type="text" id="telefono" name="telefono" required>
            
            <label for="direccion">Dirección:</label>
            <input type="text" id="direccion" name="direccion" required>
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            
            <input type="submit" value="Crear Empresa">
        </form>

        <div class="btn-container">
            <a href="empresas.php" class="btn btn-primary">Volver a empresas</a>
        </div>

        <?php

        require_once 'conexion_bd.php';

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $nit = mysqli_real_escape_string($conn, $_POST['nit']);
            $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
            $tipoEmpresa = mysqli_real_escape_string($conn, $_POST['tipoEmpresa']);
            $telefono = mysqli_real_escape_string($conn, $_POST['telefono']);
            $direccion = mysqli_real_escape_string($conn, $_POST['direccion']);
            $email = mysqli_real_escape_string($conn, $_POST['email']);

            $sql = "INSERT INTO EMPRESA (nit, nombre, tipoEmpresa, telefono, direccion, email) VALUES ('$nit', '$nombre', '$tipoEmpresa', '$telefono', '$direccion', '$email')";

            if ($conn->query($sql) === TRUE) {
                echo "<p>Nueva empresa creada correctamente</p>";
            } else {
                echo "<p class='error-message'>Error al crear la nueva empresa: " . $conn->error . "</p>";
            }
        }

        $conn->close();
        ?>
    </div>
</body>
</html>
