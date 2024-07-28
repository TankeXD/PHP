<?php
include("../../layouts/config.php");
$con = connection();

// Mostrar errores para depuración
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $id_producto = $_POST['id_producto'];
    $nombre_prod = $_POST['nombre_prod'];
    $precio_prod = $_POST['precio_prod'];
    $stock_prod = $_POST['stock_prod'];
    $descripcion_prod = $_POST['descripcion_prod'];
    $img = '';

    // Verificar si se ha subido una nueva imagen
    if (isset($_FILES['img_prod']) && $_FILES['img_prod']['error'] === UPLOAD_ERR_OK) {
        $file = $_FILES['img_prod'];
        $nombre = $file['name'];
        $tipo = $file['type'];
        $ruta_temporal = $file['tmp_name'];
        $size = $file['size'];
        $carpeta = "/my-school/assets/images/products/";

        // Verificar y crear la carpeta de destino si no existe
        $carpeta_absoluta = $_SERVER['DOCUMENT_ROOT'] . $carpeta;
        if (!is_dir($carpeta_absoluta)) {
            mkdir($carpeta_absoluta, 0777, true);
        }

        // Validar el tipo de archivo
        $allowed_types = ['image/jpg', 'image/jpeg', 'image/png'];
        if (!in_array($tipo, $allowed_types)) {
            die("El archivo no es una imagen permitida.");
        }

        // Validar el tamaño del archivo (máximo 3MB)
        if ($size > 3 * 1024 * 1024) {
            die("El tamaño de la imagen es superior a 3MB.");
        }

        // Generar un nombre único para la imagen
        $nombre_archivo = uniqid() . '_' . $nombre;

        // Mover el archivo a la carpeta de destino
        $src = $carpeta_absoluta . $nombre_archivo;
        if (move_uploaded_file($ruta_temporal, $src)) {
            $img = $carpeta . $nombre_archivo;
        } else {
            die("Error al mover el archivo cargado.");
        }
    } elseif (isset($_FILES['img_prod']['error']) && $_FILES['img_prod']['error'] !== UPLOAD_ERR_NO_FILE) {
        die("Error al subir el archivo: " . $_FILES['img_prod']['error']);
    }

    // Preparar la consulta SQL para actualizar el producto
    $sql = "UPDATE producto SET 
                nombre_prod = '$nombre_prod',
                precio_prod = '$precio_prod',
                stock_prod = '$stock_prod',
                descripcion_prod = '$descripcion_prod'";

    // Agregar la imagen a la consulta si se ha subido una nueva
    if (!empty($img)) {
        $sql .= ", ruta_img = '$img'";
    }

    $sql .= " WHERE id_producto = '$id_producto'";

    // Ejecutar la consulta SQL
    $query = mysqli_query($con, $sql);

    if ($query) {
        sleep(1.5); // Tiempo opcional de espera
        header("Location: ../../view/Product/management-product.php");
    } else {
        die("Error al ejecutar la consulta SQL: " . mysqli_error($con));
    }
} else {
    die("Acceso denegado.");
}
?>
