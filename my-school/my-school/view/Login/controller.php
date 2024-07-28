<?php


if (!empty($_POST["btningresar"])) {
    if (empty($_POST["email"]) || empty($_POST["password"])) {
        echo '<div class="alert alert-danger text-center fw-bold mx-3 mb-0 ">Por favor completa todos los campos.</div>';
    } else {
        $email = $_POST["email"];
        $password = $_POST["password"];

        // Verificar si el correo electrónico pertenece a un usuario
        $conn = connection();
        if (!$conn) {
            die("Conexión fallida: " . mysqli_connect_error());
        }

        $stmt = $conn->prepare("SELECT id_user, password, username , rol FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($id_user, $hashuser_password, $username , $rol);

        if ($stmt->fetch()) {
            // Verificar la contraseña para el usuario
            if (password_verify($password, $hashuser_password)) {
                // Iniciar sesión para el usuario
                session_start();
                $_SESSION["id_user"] = $id_user;
                $_SESSION["username"] = $username;
                $_SESSION["rol"] = $rol;
                header("location: ../../major.php"); // Redirigir a la página de inicio
                exit();
            } else {
                // La contraseña no es válida para el usuario
                echo '<div class="alert alert-danger text-center fw-bold mx-3 mb-0">Contraseña incorrecta para usuario.</div>';
            }
        } else {
            // Si el correo electrónico no pertenece a un usuario, verificamos si pertenece a un cliente
            $stmt = $conn->prepare("SELECT id_cliente,password ,nombre , apellido FROM clientes WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->bind_result($id_cliente, $hashcliente_password,$nombre,$apellido);

            if ($stmt->fetch()) {
                // Verificar la contraseña para el cliente
                if (password_verify($password, $hashcliente_password)) {
                    // Iniciar sesión para el cliente
                    session_start();
                    $_SESSION["id_cliente"] = $id_cliente;
                    $_SESSION["nombre"] = $nombre;
                    $_SESSION["apellido"] = $apellido;
                    header("location: ../../index.php"); // Redirigir a la página de inicio para clientes
                    exit();
                } else {
                    // La contraseña no es válida para el cliente
                    echo '<div class="alert alert-danger text-center fw-bold mx-3 mb-0">Contraseña incorrecta para cliente.</div>';
                }
            } else {
                // El correo electrónico no está registrado ni como usuario ni como cliente
                echo '<div class="alert alert-danger text-center fw-bold mx-3 mb-0 ">Correo electrónico no encontrado.</div>';
            }
        }

        $stmt->close();
        $conn->close();
    }
}
?>