<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("../../layouts/config.php");
$con = connection();

$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$rut = $_POST['rut'];
$email = $_POST['email'];
$password = $_POST['password'];
$hashpassword = password_hash($password, PASSWORD_BCRYPT, ['cost' => 10]);

// Comprobar si el correo electrónico ya existe
$check_email_query = "SELECT * FROM clientes WHERE email=?";
$stmt = $con->prepare($check_email_query);
if (!$stmt) {
    die("Error en la preparación de la consulta: " . $con->error);
}
$stmt->bind_param("s", $email);
$stmt->execute();
$check_email_result = $stmt->get_result();

if ($check_email_result->num_rows > 0) {
    // El correo electrónico ya existe
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js'></script>";
    echo "<link href='https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css' rel='stylesheet'>";
    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'El correo electrónico ya está registrado. Por favor, use otro.',
            }).then(() => {
                window.location.href = '../../view/Client/check-in.php';
            });
        });
    </script>";
} else {
    // El correo electrónico no existe, proceder con la inserción
    $sql = "INSERT INTO clientes (nombre, apellido, rut, email, password) VALUES (?, ?, ?, ?, ?)";
    $stmt = $con->prepare($sql);
    if (!$stmt) {
        die("Error en la preparación de la consulta de inserción: " . $con->error);
    }
    $stmt->bind_param("sssss", $nombre, $apellido, $rut, $email, $hashpassword);
    $query = $stmt->execute();

    if ($query) {
        // Retardo de 1.5 segundos
        echo "<script src='https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js'></script>";
        echo "<link href='https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css' rel='stylesheet'>";
        echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "Se Ha Registrado Con Éxito!!",
                    showConfirmButton: false,
                    timer: 1500
                });
            });
        </script>';
        sleep(1.5);
        header("Location: ../../view/Login/login.php");
    } else {
        // Capturar el mensaje de error de MySQL
        $error_message = $stmt->error;
        echo "<script src='https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js'></script>";
        echo "<link href='https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css' rel='stylesheet'>";
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Error al registrar el usuario: " . addslashes($error_message) . ". Por favor, intente nuevamente.',
                }).then(() => {
                    window.location.href = '../../view/Client/check-in.php';
                });
            });
        </script>";
    }
}
?>
