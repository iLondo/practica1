<?php
// Verificar si se ha recibido el parámetro 'nit' y si es un valor válido
if(isset($_GET['nit']) && !empty($_GET['nit'])) {
    // Incluir el archivo de conexión a la base de datos
    require_once 'conexion_bd.php';
    
    // Obtener el NIT de la empresa a eliminar
    $nit = $_GET['nit'];
    
    // Eliminar los empleados asociados a la empresa
    $sql_delete_empleados = "DELETE FROM EMPLEADO WHERE nitEmpresa = '$nit'";
    if ($conn->query($sql_delete_empleados) === TRUE) {
        // Los empleados se eliminaron correctamente, ahora podemos eliminar la empresa
        $sql_delete_empresa = "DELETE FROM EMPRESA WHERE nit = '$nit'";
        if ($conn->query($sql_delete_empresa) === TRUE) {
            // Redirigir de vuelta a la página principal
            header("Location: empresas.php");
            exit(); // Finalizar el script para evitar que se ejecute más código innecesario
        } else {
            // Si hay un error al eliminar la empresa, mostrar un mensaje de error
            echo "Error al intentar borrar la empresa: " . $conn->error;
        }
    } else {
        // Si hay un error al eliminar los empleados, mostrar un mensaje de error
        echo "Error al intentar borrar los empleados asociados a la empresa: " . $conn->error;
    }
} else {
    // Si no se proporcionó un NIT válido, mostrar un mensaje de error
    echo "No se ha proporcionado un NIT válido.";
}
// Cerrar la conexión
$conn->close();
?>
