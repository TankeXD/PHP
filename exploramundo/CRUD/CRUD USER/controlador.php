<?php
    
   
    /* Controla que todos los campos del login se completen o sean correctos */
    if (!empty($_POST["btningresar"])) {
        if (empty($_POST["email"]) || empty($_POST["password"])) {
            echo '<div class="alert alert-danger text-center fw-bold mx-3 mb-0 ">CAMPOS VACÍOS</div>';
        } else {
            $email = $_POST["email"];
            $password = $_POST["password"];
    
            // Obtener el hash de la contraseña desde la base de datos
          
            $conn = connection();
            if (!$conn) {
                die("Conexión fallida: " . mysqli_connect_error());
            }
    
            $stmt = $conn->prepare("SELECT id_user, password FROM users WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->bind_result($id_user, $hash_password);
    
            if ($stmt->fetch()) {
                // se hace la verificación de contraseña ingresada con la que esta hasheada
                // echo "Contraseña ingresada: $password<br>";
                // echo "Hash de la base de datos: $hash_password<br>";
               
                if (password_verify($password, $hash_password)) {
                    // La contraseña es válida
                    session_start();
                    $_SESSION["id_user"] = $id_user;
                    header("location: principal.php");
                    exit();
                } else {
                    // La contraseña no es válida
                    echo '<div class="alert alert-danger text-center fw-bold mx-3 mb-0">ACCESO DENEGADO</div>';
                }
            } else {
                echo '<div class="alert alert-danger text-center fw-bold mx-3 mb-0 ">Correo electrónico no encontrado en la base de datos.</div>';
            }
    
            $stmt->close();
            $conn->close();
        }
    }
?>