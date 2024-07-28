<?php
// Include config file
require_once "layouts/config.php";

$useremail_err = $password_err = $confirm_password_err = $codigo_err = $msg = "";

// Connect to the database
$connect = connection();

// Check the connection
if (!$connect) {
  die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Sanitize and validate inputs
  $codigo = trim($_POST["codigo"]);
  $password = trim($_POST["password"]);
  $confirm_password = trim($_POST["confirm_password"]);

  // Validate codigo
  if (empty($codigo)) {
    $codigo_err = "Por favor, ingrese el código.";
  } else {
    $sql = "SELECT * FROM clientes WHERE codigo_recuperacion = ?";
    if ($stmt = mysqli_prepare($connect, $sql)) {
      mysqli_stmt_bind_param($stmt, "i", $codigo);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      if (mysqli_num_rows($result) != 1) {
        $codigo_err = "Código inválido.";
      }
    }
  }

  // Validate password
  if (empty($password)) {
    $password_err = "Por favor, ingrese una contraseña.";
  } elseif (strlen($password) < 8) {
    $password_err = "La contraseña debe tener al menos 8 caracteres.";
  } elseif (!preg_match("/[A-Z]/", $password) || !preg_match("/[a-z]/", $password) || !preg_match("/[0-9]/", $password)) {
    $password_err = "La contraseña debe contener mayúsculas, minúsculas y números.";
  }

  // Validate confirm password
  if (empty($confirm_password)) {
    $confirm_password_err = "Por favor, confirme su contraseña.";
  } elseif ($password !== $confirm_password) {
    $confirm_password_err = "Las contraseñas no coinciden.";
  }

  // If no errors, update the password
  if (empty($codigo_err) && empty($password_err) && empty($confirm_password_err)) {
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $update_sql = "UPDATE clientes SET password = ?, codigo_recuperacion = NULL WHERE codigo_recuperacion = ?";
    if ($update_stmt = mysqli_prepare($connect, $update_sql)) {
      mysqli_stmt_bind_param($update_stmt, "si", $hashed_password, $codigo);
      if (mysqli_stmt_execute($update_stmt)) {
        $msg = "Contraseña actualizada correctamente.";
      } else {
        $msg = "Error al actualizar la contraseña.";
      }
    }
  }
}
?>

<?php include 'layouts/main.php'; ?>

<head>
    <?php includeFileWithVariables('layouts/title-meta.php', array('title' => 'Create New Password')); ?>
    <?php include 'layouts/head-css.php'; ?>
</head>

<body>
    <div class="auth-page-wrapper pt-5">
        <!-- auth page bg -->
        <div class="auth-one-bg-position auth-one-bg" id="auth-particles">
            <div class="bg-overlay"></div>
            <div class="shape">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1440 120">
                    <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
                </svg>
            </div>
        </div>

        <!-- auth page content -->
        <div class="auth-page-content">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card mt-4">
                            <div class="card-body p-4">
                                <div class="text-center mt-2">
                                    <h5 class="text-primary">Crear nueva contraseña</h5>
                                    <p class="text-muted">Su nueva contraseña debe ser diferente de la contraseña utilizada anteriormente.</p>
                                </div>
                                <div class="p-2">
                                    <form action="process-password.php" method="post">
                                        <div class="mb-3">
                                            <label class="form-label" for="form3Example3">Código</label>
                                            <input type="number" id="form3Example3" class="form-control" placeholder="Ingrese Código" name="codigo" required />
                                            <span class="text-danger"><?php echo $codigo_err; ?></span>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label" for="password-input">Contraseña</label>
                                            <div class="position-relative auth-pass-inputgroup">
                                                <input type="password" class="form-control pe-5 password-input" name="password" onpaste="return false" placeholder="Ingrese Contraseña" id="password-input" required>
                                                <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                            </div>
                                            <span class="text-danger"><?php echo $password_err; ?></span>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label" for="confirm-password-input">Confirmar Contraseña</label>
                                            <div class="position-relative auth-pass-inputgroup mb-3">
                                                <input type="password" class="form-control pe-5 password-input" name="confirm_password" onpaste="return false" placeholder="Ingrese Confirmación Contraseña" id="confirm-password-input" required>
                                                <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="confirm-password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                            </div>
                                            <span class="text-danger"><?php echo $confirm_password_err; ?></span>
                                        </div>

                                        <div class="mt-4">
                                            <button class="btn btn-success w-100" type="submit">Restaurar Contraseña</button>
                                        </div>

                                        <span class="text-success"><?php echo $msg; ?></span>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 text-center">
                            <p class="mb-0">Espera, recuerdo mi contraseña...
                                <a href="index.php" class="fw-semibold text-primary text-decoration-underline">Click Aquí</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <p class="mb-0 text-muted">&copy;
                                <script>
                                    document.write(new Date().getFullYear())
                                </script> Mi Colegio <i class="mdi mdi-heart text-danger"></i>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <?php include 'layouts/vendor-scripts.php'; ?>
    <script src="assets/libs/particles.js/particles.js"></script>
    <script src="assets/js/pages/particles.app.js"></script>
    <script src="assets/js/pages/password-create.init.js"></script>
</body>

</html>
