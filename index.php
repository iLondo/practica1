<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Estilo adicional si es necesario */
        body {
            padding: 20px;
         }
        .btn-container {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container text-center">
        <h1 class="mb-4">¡Bienvenido!</h1>
        <div class="row justify-content-center">
            <div class="col-auto">
                <form action="empresas.php" method="get">
                    <button type="submit" class="btn btn-primary btn btn-info">Gestión de empresas</button>
                </form>
            </div>
            <div class="col-auto">
                <form action="empleados.php" method="get">
                    <button type="submit" class="btn btn-primary btn btn-info">Gestión de empleados</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (opcional, si necesitas funcionalidades como botones desplegables, modales, etc.) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
