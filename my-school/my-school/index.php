<?php
session_start();
$id_cliente = isset($_SESSION['id_cliente']) ? $_SESSION['id_cliente'] : null;
?>


<?php include 'layouts/main.php'; ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <?php includeFileWithVariables('layouts/title-meta.php', array('title' => 'Inicio')); ?>
    <?php include 'layouts/head-css.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <style>
        /* color de fondo general */
        body {
            background-color: rgba(215, 255, 255, 0.9);
        }

        .navbar {
            background: linear-gradient(45deg, #6ab1d7, #33d9b2);
        }

        .navbar-nav .nav-link {
            color: white !important;
            font-size: 1rem;
            margin: 0 10px;
            transition: color 0.3s ease;
        }

        .navbar-nav .nav-link:hover {
            color: rgba(15, 34, 245) !important;
        }

        .btn-custom {
            color: white !important;
            background-color: rgba(32, 189, 251, 0.43);
            border-color: rgba(173, 216, 230, 1);
        }

        .btn-custom:hover {
            background-color: rgba(32, 189, 251, 1);
            border-color: rgba(32, 189, 251, 0.43);
        }

        .social-icons i {
            color: white;
            font-size: 1.2rem;
            margin: 0 10px;
            transition: color 0.3s ease;
        }

        .social-icons i:hover {
            color: rgba(15, 34, 245);
        }

        /* estilos para el navbar privado de clientes el sidebar_index */
        #scrollbar .navbar-nav .nav-link:hover {
            color: rgba(20, 157, 255) !important;
        }

        #scrollbar .navbar-nav .nav-link {
            color: black !important;
        }

        #scrollbar .container-fluid {
            display: flex;
            justify-content: center;
        }

        #scrollbar .navbar-nav {
            display: flex;
            align-items: center;
            list-style: none;
            padding: 0;
            margin: 0;
        }

        #scrollbar .navbar-nav .menu-title {
            margin: 0 10px;
        }

        #scrollbar .navbar-nav .menu-title span {
            color: black;
        }
    </style>
</head>

<body>
    <!-- Begin page -->
    <div id="layout-wrapper" class="d-flex flex-column min-vh-100">
        <div class="page-content">
            <!-- este contiene a todo el navbar y slider -->
            <div class="container-fluid">
                <?php if (!$id_cliente) : ?>
                    <?php include 'view/Client/public.php'; ?>
                    <!-- Aqui ya empieza contenido inicio de sesion -->
                <?php else : ?>
                    <!-- Mostrar contenido privado solo para usuarios autenticados -->
                    <?php include 'layouts/topbar_index.php'; ?>
                    <?php include 'layouts/sidebar_index.php'; ?>
                    <?php include 'view/Client/private.php'; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php include 'layouts/footer_index.php'; ?>
    <?php include 'layouts/vendor-scripts.php'; ?>
    <script src="assets/js/app.js"></script>
    <!-- SCRIPT PARA ALERTAR DE ELIMINACION DE ALUMNO -->
    <script>
        function confirmacion(event, id_alumno) {
            console.log("ID of the student to delete:", id_alumno);
            // Evita que el enlace se siga automáticamente
            event.preventDefault();
            // Utilizamos SweetAlert en lugar de confirm
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: "btn btn-success",
                    cancelButton: "btn btn-danger"
                },
                buttonsStyling: false
            });

            // Mostramos la ventana de confirmación de SweetAlert
            return swalWithBootstrapButtons.fire({
                title: "¿Desea Realmente Borrar El Alumno",
                text: "Esta acción no se puede deshacer",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Sí, borrar!",
                cancelButtonText: "No, cancelar!",
                reverseButtons: true
            }).then((result) => {
                // Según la decisión del usuario se ejecuta si entrar al if o else
                if (result.isConfirmed) {
                    swalWithBootstrapButtons.fire(
                        "Borrado!",
                        "Alumno Eliminado con Exíto.",
                        "success"

                    );
                    setTimeout(() => {
                        window.location.href = "Models/Crud-student/delete-student.php?id_alumno=" + id_alumno;
                    }, 1500); // se controla que se demore 1.5 segundos para la eliminacion 


                } else if (
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    // Aquí maneja la cancelación
                    swalWithBootstrapButtons.fire(
                        "Cancelado",
                        "Alumno a salvo :)",
                        "error"
                    );
                }
            });
        }
    </script>
    <!-- JavaScript para la funcionalidad de select dependiente region - comuna -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const regionSelect = document.getElementById('region');
            const comunaSelect = document.getElementById('comuna');

            regionSelect.addEventListener('change', function() {
                const idRegion = this.value.split('|')[0]; // Obtener el ID de la región seleccionada

                fetch('view/Course/get-commune.php?id_region=' + idRegion)
                    .then(response => response.json())
                    .then(data => {
                        comunaSelect.innerHTML = '<option selected disabled>SELECCIONE COMUNA</option>';
                        data.forEach(comuna => {
                            const option = document.createElement('option');
                            option.value = comuna.id_comuna + '|' + comuna.nombre_comuna;
                            option.textContent = comuna.nombre_comuna;
                            comunaSelect.appendChild(option);
                        });
                    });
            });
        });
    </script>
    <!-- JavaScript para la funcionalidad de select dependiente de comuna - colegio -->
    <script>
        <?php
        error_reporting(E_ALL);
        ?>
        document.addEventListener("DOMContentLoaded", function() {
            const comunaSelect = document.getElementById('comuna');
            const colegioSelect = document.getElementById('colegio');

            comunaSelect.addEventListener('change', function() {
                const idComuna = this.value.split('|')[0]; // Obtener el ID de la comuna seleccionada
                console.log(idComuna);
                fetch('view/Course/get-school.php?id_comuna=' + idComuna)
                    .then(response => response.json()) // Agrega .json() aquí para parsear la respuesta como JSON
                    .then(data => {
                        colegioSelect.innerHTML = '<option selected disabled>SELECCIONE COLEGIO</option>';
                        data.forEach(colegio => {
                            const option = document.createElement('option');
                            option.value = colegio.id_colegio + '|' + colegio.nombre_colegio;
                            option.textContent = colegio.nombre_colegio;
                            colegioSelect.appendChild(option);
                        });
                    });

            });
        });
    </script>
    <!-- JavaScript para la funcionalidad de select dependiente de colegio - cursos -->
    <script>
        <?php
        error_reporting(E_ALL);
        ?>
        document.addEventListener("DOMContentLoaded", function() {
            const colegioSelect = document.getElementById('colegio');
            const cursoSelect = document.getElementById('curso');

            colegioSelect.addEventListener('change', function() {
                const idColegio = this.value.split('|')[0]; // Obtener el ID de la comuna seleccionada
                console.log(idColegio);
                fetch('view/Course/get-course.php?id_colegio=' + idColegio)
                    .then(response => response.json()) // Agrega .json() aquí para parsear la respuesta como JSON
                    .then(data => {
                        cursoSelect.innerHTML = '<option selected disabled>SELECCIONE CURSO</option>';
                        data.forEach(cursos => {
                            const option = document.createElement('option');
                            option.value = cursos.id_curso;
                            option.textContent = cursos.curso;
                            cursoSelect.appendChild(option);
                        });
                    });

            });
        });
    </script>
    <!-- Script para hacer automatico el rut y controlado -->
    <script>
        function formatearRut(input) {
            // Obtener solo los dígitos y la letra 'K/k'
            var value = input.value.replace(/[^0-9kK]/g, '').toUpperCase();

            // Limitar a solo poner 12 digitos contando puntos y guión
            if (value.length > 9) {
                value = value.slice(0, 9) + value.slice(9, 9);
            }

            // Formatear el RUT
            var formattedValue = '';
            if (value.length > 1) {
                var num = value.slice(0, -1);
                var dv = value.slice(-1);
                formattedValue = num.replace(/\B(?=(\d{3})+(?!\d))/g, '.') + '-' + dv;
            } else {
                formattedValue = value;
            }

            // Actualizar el valor del input con el formato
            input.value = formattedValue;
        }
    </script>
    <script>
        function Mayuscula(input) {
            input.value = input.value.toUpperCase();
        }
    </script>
    <!-- Script Para hacer Automatica la inserción de horizontal -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Selecciona el input de la opción horizontal y simula un cambio para activar cualquier lógica de diseño
            const horizontalLayoutInput = document.getElementById("customizer-layout02");
            horizontalLayoutInput.checked = true;
            horizontalLayoutInput.dispatchEvent(new Event('change'));
        });
    </script>
</body>

</html>