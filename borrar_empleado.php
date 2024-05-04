<?php
// Verificar si se ha recibido el parámetro 'nit' y si es un valor válido
if(isset($_GET['numeroID']) && !empty($_GET['numeroID'])) {
    // Incluir el archivo de conexión a la base de datos
    require_once 'conexion_bd.php';
    
    // Obtener el NIT de la empresa a eliminar
    $numeroID = $_GET['numeroID'];
    
        $sql_delete_empleados = "DELETE FROM EMPLEADO WHERE numeroID = '$numeroID'";
        if ($conn->query($sql_delete_empleados) === TRUE) {
            // Redirigir de vuelta a la página principal
            header("Location: empleados.php");
            exit(); // Finalizar el script para evitar que se ejecute más código innecesario
        } else {
            // Si hay un error al eliminar la empresa, mostrar un mensaje de error
            echo "Error al intentar borrar la empresa: " . $conn->error;
        }
    } else {
        // Si hay un error al eliminar los empleados, mostrar un mensaje de error
        echo "Error al intentar borrar los empleados asociados a la empresa: " . $conn->error;
    }

// Cerrar la conexión
$conn->close();
?>