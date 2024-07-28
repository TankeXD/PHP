<?php
// Include config file
require_once "layouts/config.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/vendor/phpmailer/src/Exception.php';
require_once __DIR__ . '/vendor/phpmailer/src/PHPMailer.php';
require_once __DIR__ . '/vendor/phpmailer/src/SMTP.php';

$useremail_err = $msg = "";

// Connect to the database
$connect = connection();

// Check the connection
if (!$connect) {
  die("Connection failed: " . mysqli_connect_error());
}

// Passing true in constructor enables exceptions in PHPMailer
$mail = new PHPMailer(true);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Sanitize email input
  $useremail = filter_var(trim($_POST["useremail"]), FILTER_SANITIZE_EMAIL);

  // Validate email input
  if (!filter_var($useremail, FILTER_VALIDATE_EMAIL)) {
    $useremail_err = "Formato de correo inválido.";
  } else {
    // Check if email exists in the database
    $sql = "SELECT * FROM clientes WHERE email = ?";
    if ($stmt = mysqli_prepare($connect, $sql)) {
      mysqli_stmt_bind_param($stmt, "s", $useremail);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);

      if (mysqli_num_rows($result) == 1) {
        try {
          // Generar un código aleatorio
          $reset_code = strtoupper(bin2hex(random_bytes(2)));

          // Store the code and email in the database
          $sql_insert = "INSERT INTO password_resets (email, code) VALUES (?, ?) ON DUPLICATE KEY UPDATE code=?";
          if ($stmt_insert = mysqli_prepare($connect, $sql_insert)) {
            mysqli_stmt_bind_param($stmt_insert, "sss", $useremail, $reset_code, $reset_code);
            mysqli_stmt_execute($stmt_insert);
          }

          // Server settings
          $mail->isSMTP();
          $mail->Host = 'smtp.gmail.com';
          $mail->SMTPAuth = true;
          $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
          $mail->Port = 587;

          $mail->Username = 'soportemicolegio@gmail.com';
          $mail->Password = "zguk epyp qgwb crra";

          // Sender and recipient settings
          $mail->setFrom('soportemicolegio@gmail.com', "Soporte Mi Colegio");
          $mail->addAddress($useremail, ""); // to whom the email is sent

          // Setting the email content
          $mail->IsHTML(true);  // Habilitar el soporte HTML
          $mail->CharSet = 'UTF-8';  // Establecer la codificación a UTF-8
          $mail->Subject = "Recuperación de Contraseña Mi Colegio";
          $mail->Body = '<!DOCTYPE html>
              <html lang="es">
              <head>
              <meta charset="UTF-8">
              <meta name="viewport" content="width=device-width, initial-scale=1.0">
              <style>
                body {
                  font-family: Arial, Helvetica, sans-serif;
                  color: #333;
                  background-color: #f4f4f4;
                  margin: 0;
                  padding: 0;
                }
                .container {
                  width: 100%;
                  padding: 20px;
                  background-color: #fff;
                }
                .header {
                  background-color: #49b4ed;
                  color: white;
                  padding: 10px 0;
                  text-align: center;
                }
                .header img {
                  width: 100px;
                }
                .content {
                  padding: 20px;
                  text-align: center;
                }
                .content h1 {
                  color: #49b4ed;
                }
                .button {
                  display: inline-block;
                  padding: 10px 20px;
                  margin: 20px 0;
                  background-color: #49b4ed;
                  color: white;
                  text-decoration: none;
                  border-radius: 5px;
                }
                .footer {
                  background-color: #f4f4f4;
                  padding: 10px;
                  text-align: center;
                  font-size: 12px;
                  color: #777;
                }
              </style>
              </head>
              <body>
                <div class="container">
                  <div class="header">
                    <img src="https://cdn-icons-png.flaticon.com/512/1177/1177568.png" alt="Logo">
                    <h1>Mi Colegio</h1>
                  </div>
                  <div class="content">
                    <h1>¡Restablece tu contraseña!</h1>
                    <p>Hola, usuario</p>
                    <p>Para restablecer tu contraseña, haz clic en el botón de abajo o utiliza el siguiente código: <strong style="font-size: 25px;">' . $reset_code . '</strong></p>
                    <a href="http://localhost/my-school/process-password.php?code=' . $reset_code . '" class="button">Restablecer Contraseña</a>
                    <p>Si no has solicitado restablecer tu contraseña, ignora este mensaje.</p>
                  </div>
                  <div class="footer">
                    <p>Este mensaje fue enviado por Mi Colegio. Si tienes alguna pregunta, contáctanos en soporte@micolegio.com</p>
                  </div>
                </div>
              </body>
              </html>';
          $mail->send();
          $msg = "El correo ha sido enviado.";
        } catch (Exception $e) {
          $msg = "El correo no pudo ser enviado. Mailer Error: {$mail->ErrorInfo}";
        }
      } else {
        $useremail_err = "Correo no registrado.";
      }
    }
  }
}
?>


<?php include 'layouts/main.php'; ?>

<head>

  <?php includeFileWithVariables('layouts/title-meta.php', array('title' => 'Olvido de Contraseña')); ?>

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
        <div class="row">
          <div class="col-lg-12">
            <div class="text-center mt-sm-5 mb-4 text-white-50">
              <div>
                <a href="index.php" class="d-inline-block auth-logo">
                  <img src="assets/images/logo-light.png" alt="" height="20">
                </a>
              </div>
            </div>
          </div>
        </div>
        <!-- end row -->

        <div class="row justify-content-center">
          <div class="col-md-8 col-lg-6 col-xl-5">
            <div class="card mt-4">

              <div class="card-body p-4">
                <div class="text-center mt-2">
                  <h5 class="text-primary">¿Has olvidado tu contraseña?</h5>
                  <p class="text-muted">Restablecer contraseña</p>

                  <lord-icon src="https://cdn.lordicon.com/rhvddzym.json" trigger="loop" colors="primary:#0ab39c" class="avatar-xl">
                  </lord-icon>

                </div>

                <div class="alert border-0 alert-warning text-center mb-2 mx-2" role="alert">
                  ¡Ingresa tu correo electrónico y te enviaremos las instrucciones!
                </div>
                <div class="p-2">
                  <?php if ($msg) { ?>
                    <div class="alert alert-success text-center mb-4 mt-4 pt-2" role="alert"><?php echo $msg; ?></div>
                  <?php } ?>
                  <form action="<?php echo htmlentities($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="mb-4 <?php echo (!empty($useremail_err)) ? 'has-error' : ''; ?>">
                      <label class="form-label">Correo Electronico</label>
                      <input type="email" class="form-control" name="useremail" id="email" placeholder="Ingrese Email">
                      <span class="text-danger"><?php echo $useremail_err; ?></span>
                    </div>

                    <div class="text-center mt-4">
                      <button class="btn btn-success w-100" type="submit">Enviar</button>
                    </div>
                  </form><!-- end form -->
                </div>
              </div>
              <!-- end card body -->
            </div>
            <!-- end card -->

            <div class="mt-4 text-center">
              <p class="mb-0">Espera, recuerdo mi contraseña... <a href="/my-school/view/Login/login.php" class="fw-semibold text-primary text-decoration-underline"> Click Aquí</a> </p>
            </div>

          </div>
        </div>
        <!-- end row -->
      </div>
      <!-- end container -->
    </div>
    <!-- end auth page content -->

    <!-- footer -->
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
    <!-- end Footer -->
  </div>
  <!-- end auth-page-wrapper -->

  <?php include 'layouts/vendor-scripts.php'; ?>

  <!-- particles js -->
  <script src="assets/libs/particles.js/particles.js"></script>

  <!-- particles app js -->
  <script src="assets/js/pages/particles.app.js"></script>
</body>

</html>