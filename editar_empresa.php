<?php
// Incluir el archivo de conexión a la base de datos
require_once 'conexion_bd.php';

// Definir variables y establecer valores predeterminados
$mensaje = '';

// Verificar si se ha enviado una solicitud POST para editar la empresa
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar los datos del formulario
    $nit_original = $_POST['nit_original'];
    $nit = $_POST['nit'];
    $tipoEmpresa = $_POST['tipoEmpresa'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];
    $email = $_POST['email'];

    // Crear la consulta SQL para actualizar la empresa
    $sql = "UPDATE EMPRESA SET nit='$nit', tipoEmpresa='$tipoEmpresa', telefono='$telefono', direccion='$direccion', email='$email' WHERE nit='$nit_original'";

    // Ejecutar la consulta SQL
    if ($conn->query($sql) === TRUE) {
        $mensaje = "Los cambios en la empresa se han guardado correctamente.";
    } else {
        $mensaje = "Error al guardar los cambios en la empresa: " . $conn->error;
    }
}

if(isset($_GET['nit'])) {
    $nit_empresa = $_GET['nit'];

    $sql = "SELECT * FROM EMPRESA WHERE nit = '$nit_empresa'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        $empresa = $result->fetch_assoc();
        ?>

        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Editar Empresa</title>
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
                <h1>Editar Empresa</h1>
                <?php echo $mensaje; ?>
                <form action="editar_empresa.php?nit=<?php echo $nit_empresa; ?>" method="post">
                    <input type="hidden" name="nit_original" value="<?php echo $empresa['nit']; ?>">
                    <div class="form-group">
                        <label for="nit">NIT:</label>
                        <input type="text" id="nit" name="nit" value="<?php echo $empresa['nit']; ?>" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="tipoEmpresa">Tipo de Empresa:</label>
                        <input type="text" id="tipoEmpresa" name="tipoEmpresa" value="<?php echo $empresa['tipoEmpresa']; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="telefono">Teléfono:</label>
                        <input type="text" id="telefono" name="telefono" value="<?php echo $empresa['telefono']; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="direccion">Dirección:</label>
                        <input type="text" id="direccion" name="direccion" value="<?php echo $empresa['direccion']; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" value="<?php echo $empresa['email']; ?>" class="form-control">
                    </div>
                    <input type="submit" value="Guardar Cambios" class="btn btn-primary">
                </form>
                <div class="btn-container">
                    <a href="empresas.php" class="btn btn-primary">Volver a empresas</a>
                </div>
            </div>
        </body>
        </html>

        <?php
    } else {
        echo "<p>No se encontró ninguna empresa con el NIT proporcionado.</p>";
    }
} else {
    echo "<p>No se proporcionó un NIT de empresa para editar.</p>";
}

$conn->close();
?>
