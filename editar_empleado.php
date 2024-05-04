<?php
// Incluir el archivo de conexión a la base de datos
require_once 'conexion_bd.php';

// Definir variables y establecer valores predeterminados
$mensaje = '';

// Verificar si se ha enviado una solicitud POST para editar el empleado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar los datos del formulario
    $numeroID_original = $_POST['numeroID_original'];
    $numeroID = $_POST['numeroID'];
    $tipoID = $_POST['tipoID'];
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];
    $email = $_POST['email'];
    $nitEmpresa = $_POST['nitEmpresa'];
    $cargo = $_POST['cargo'];
    $salario = $_POST['salario'];

    // Crear la consulta SQL para actualizar el empleado
    $sql = "UPDATE EMPLEADO SET numeroID='$numeroID', tipoID='$tipoID', nombres='$nombres', apellidos='$apellidos', telefono='$telefono', direccion='$direccion', email='$email', nitEmpresa='$nitEmpresa', cargo='$cargo', salario='$salario' WHERE numeroID='$numeroID_original'";

    // Ejecutar la consulta SQL
    if ($conn->query($sql) === TRUE) {
        $mensaje = "Los cambios en el empleado se han guardado correctamente.";
    } else {
        $mensaje = "Error al guardar los cambios en el empleado: " . $conn->error;
    }
}

// Verificar si se ha proporcionado un número de ID de empleado para editar
if(isset($_GET['numeroID'])) {
    $numeroID_empleado = $_GET['numeroID'];

    // Consultar el empleado correspondiente al número de ID proporcionado
    $sql = "SELECT * FROM EMPLEADO WHERE numeroID = '$numeroID_empleado'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Mostrar el formulario de edición
        $empleado = $result->fetch_assoc();
        ?>

        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Editar Empleado</title>
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
                .success-message {
                    color: green;
                }
            </style>
        </head>
        <body>
            <div class="container">
                <h1>Editar Empleado</h1>
                <?php echo $mensaje; // Mostrar mensaje de éxito o error ?>
                <form action="editar_empleado.php?numeroID=<?php echo $numeroID_empleado; ?>" method="post">
                    <input type="hidden" name="numeroID_original" value="<?php echo $empleado['numeroID']; ?>">
                    <div class="form-group">
                        <label for="numeroID">Número de ID:</label>
                        <input type="text" id="numeroID" name="numeroID" value="<?php echo $empleado['numeroID']; ?>" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="tipoID">Tipo de ID:</label>
                        <input type="text" id="tipoID" name="tipoID" value="<?php echo $empleado['tipoID']; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="nombres">Nombres:</label>
                        <input type="text" id="nombres" name="nombres" value="<?php echo $empleado['nombres']; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="apellidos">Apellidos:</label>
                        <input type="text" id="apellidos" name="apellidos" value="<?php echo $empleado['apellidos']; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="telefono">Teléfono:</label>
                        <input type="text" id="telefono" name="telefono" value="<?php echo $empleado['telefono']; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="direccion">Dirección:</label>
                        <input type="text" id="direccion" name="direccion" value="<?php echo $empleado['direccion']; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" value="<?php echo $empleado['email']; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="nitEmpresa">NIT Empresa:</label>
                        <input type="text" id="nitEmpresa" name="nitEmpresa" value="<?php echo $empleado['nitEmpresa']; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="cargo">Cargo:</label>
                        <input type="text" id="cargo" name="cargo" value="<?php echo $empleado['cargo']; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="salario">Salario:</label>
                        <input type="text" id="salario" name="salario" value="<?php echo $empleado['salario']; ?>" class="form-control">
                    </div>
                    <input type="submit" value="Guardar Cambios" class="btn btn-primary">
                </form>
                <div class="btn-container">
                    <a href="empleados.php" class="btn btn-primary">Volver a empleados</a>
                </div>
            </div>
        </body>
        </html>

        <?php
    } else {
        echo "<p>No se encontró ningún empleado con el número de ID proporcionado.</p>";
    }
} else {
    echo "<p>No se proporcionó un número de ID de empleado para editar.</p>";
}

// Cerrar la conexión
$conn->close();
?>
