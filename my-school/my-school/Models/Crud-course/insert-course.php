<?php
// Incluye el archivo de configuración de la base de datos
include("../../layouts/config.php");

// Verificar el método de solicitud
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conexión a la base de datos
    $con = connection();

    // Obtener los datos del formulario
    $id_colegio = $_POST['colegio']; // Nombre del campo en el select de colegios
    $numero_curso = $_POST['curso'];
    $letra = $_POST['letra'];
    $curso = $numero_curso . " " . $letra;

    // Validar los datos del formulario
    if (empty($id_colegio) || empty($numero_curso) || empty($letra)) {
        echo "Por favor, complete todos los campos.";
        exit();
    }
    echo "Por favor, complete todos los campos.$curso";
    // Insertar el nuevo curso
    $sql_insert = "INSERT INTO cursos (id_colegio, curso) VALUES (?, ?)";
    $stmt_insert = $con->prepare($sql_insert);
    $stmt_insert->bind_param("is", $id_colegio, $curso);

    if ($stmt_insert->execute()) {
        echo "Curso agregado exitosamente.";
        sleep(1.5);
        Header("Location: ../../view/Course/add-course.php");
    } else {
        echo "Error al agregar el curso: " . $stmt_insert->error;
        exit();
    }

    // Cerrar la conexión y redirigir de vuelta a la página principal después de la inserción
    $stmt_insert->close();
    mysqli_close($con);
}
?>
