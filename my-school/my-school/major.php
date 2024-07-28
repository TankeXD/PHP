<?php
session_start();
// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['id_user'])) {
    header("location: index.php");
    exit();
}

// Configuración de la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mi_colegio";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Consulta para obtener el número de regiones
$sql_regiones = "SELECT COUNT(*) as total_regiones FROM regiones";
$result_regiones = $conn->query($sql_regiones);
$total_regiones = $result_regiones->fetch_assoc()['total_regiones'];

// Consulta para obtener el número de comunas
$sql_comunas = "SELECT COUNT(*) as total_comunas FROM comunas";
$result_comunas = $conn->query($sql_comunas);
$total_comunas = $result_comunas->fetch_assoc()['total_comunas'];

// Consulta para obtener el número de colegios
$sql_colegios = "SELECT COUNT(*) as total_colegios FROM colegio";
$result_colegios = $conn->query($sql_colegios);
$total_colegios = $result_colegios->fetch_assoc()['total_colegios'];

// Consulta para obtener la cantidad de comunas por región, ordenando por id_region
$sql_comunas_region = "
    SELECT r.id_region, r.nombre_region, COUNT(c.id_comuna) as total_comunas
    FROM comunas c
    JOIN regiones r ON c.id_region = r.id_region
    GROUP BY r.id_region, r.nombre_region
    ORDER BY r.id_region ASC
";
$result_comunas_region = $conn->query($sql_comunas_region);

// Crear un array para almacenar los datos del gráfico
$chartData = [];
while ($row = $result_comunas_region->fetch_assoc()) {
    // Asigna un nombre de región en el formato "Región I", "Región II", etc.
    $row['nombre_region'] = 'Región ' . intToRoman($row['id_region']);
    $chartData[] = $row;
}

// Función para convertir un número entero a un número romano
function intToRoman($num)
{
    $n = intval($num);
    $res = '';

    $romanNumber_Array = array(
        'M'  => 1000,
        'CM' => 900,
        'D'  => 500,
        'CD' => 400,
        'C'  => 100,
        'XC' => 90,
        'L'  => 50,
        'XL' => 40,
        'X'  => 10,
        'IX' => 9,
        'V'  => 5,
        'IV' => 4,
        'I'  => 1
    );

    foreach ($romanNumber_Array as $roman => $number) {
        $matches = intval($n / $number);
        $res .= str_repeat($roman, $matches);
        $n = $n % $number;
    }

    return $res;
}

?>

<?php include 'layouts/main.php'; ?>

<head>
    <?php includeFileWithVariables('layouts/title-meta.php', array('title' => 'Inicio')); ?>
    <?php include 'layouts/head-css.php'; ?>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link href="assets/libs/jsvectormap/css/jsvectormap.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Selecciona el input de la opción horizontal y simula un cambio para activar cualquier lógica de diseño
            const horizontalLayoutInput = document.getElementById("customizer-layout01");
            horizontalLayoutInput.checked = true;
            horizontalLayoutInput.dispatchEvent(new Event('change'));
        });
    </script>

    <style>
        /* Definir colores pasteles */
        .card.bg-primary {
            background-color: #B9FEFF !important;
            /* Amarillo dorado */
        }

        .card.bg-success {
            background-color: #B9FEFF !important;
            /* Salmón claro */
        }

        .card.bg-info {
            background-color: #B9FEFF !important;
            /* Azul claro */
        }

        .card.bg-warning {
            background-color: #B9FEFF !important;
            /* Rosa claro */
        }

        .card.bg-danger {
            background-color: #B9FEFF !important;
            /* Azul cielo claro */
        }

        .sidebar-label {
            color: #ffffff;

        }

        .sidebar-label:hover {
            color: #25a0e2;
        }
    </style>
</head>

<body>
    <!-- Begin page -->
    <div id="layout-wrapper">
        <?php include 'layouts/menu.php'; ?>
        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <?php includeFileWithVariables('layouts/page-title.php', array('pagetitle' => 'Inicio', 'title' => 'Tablero')); ?>

                    <div class="row">
                        <!-- Columna para horizontal -->
                        <div class="col-4">
                            <div class="form-check card-radio" style="display: none;">
                                <input id="customizer-layout01" name="data-layout" type="radio" value="vertical">

                            </div>
                        </div>
                        <!-- Fin de la columna para horizontal-->
                    </div>
                    <div class="row">
                        <div class="col-xl-4">
                            <div class="card card-animate">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-primary-subtle text-primary rounded-2 fs-2">
                                                <i class="las la-globe"></i>
                                            </span>
                                        </div>
                                        <div class="flex-grow-1 overflow-hidden ms-3">
                                            <a href="view/Region/regions.php" style="all: unset; text-decoration: none; color: inherit;">
                                                <p class="text-uppercase fw-medium text-muted text-truncate mb-3">Regiones</p>
                                                <div class="d-flex align-items-center mb-3">
                                                    <h4 class="fs-4 flex-grow-1 mb-0"><span id="regiones-count">0</span></h4>
                                                    <span class="badge bg-danger-subtle text-danger fs-12"></span>
                                                </div>
                                                <p class="text-muted text-truncate mb-0">N° Regiones Activas</p>
                                            </a>
                                        </div>
                                    </div>
                                </div><!-- end card body -->
                            </div>
                        </div><!-- end col -->

                        <div class="col-xl-4">
                            <div class="card card-animate">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-primary-subtle text-primary rounded-2 fs-2">
                                                <i class="ri-community-line"></i>
                                            </span>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <p class="text-uppercase fw-medium text-muted mb-3">Comunas</p>
                                            <div class="d-flex align-items-center mb-3">
                                                <h4 class="fs-4 flex-grow-1 mb-0"><span id="comunas-count">0</span></h4>
                                                <span class="badge bg-success-subtle text-success fs-12"></span>
                                            </div>
                                            <p class="text-muted mb-0">N° Comunas Activas</p>
                                        </div>
                                    </div>
                                </div><!-- end card body -->
                            </div>
                        </div><!-- end col -->

                        <div class="col-xl-4">
                            <div class="card card-animate">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-primary-subtle text-primary rounded-2 fs-2">
                                                <i class="las la-university"></i>
                                            </span>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <p class="text-uppercase fw-medium text-muted mb-3">Colegios</p>
                                            <div class="d-flex align-items-center mb-3">
                                                <h4 class="fs-4 flex-grow-1 mb-0"><span id="colegios-count">0</span></h4>
                                                <span class="badge bg-success-subtle text-success fs-12"></span>
                                            </div>
                                            <p class="text-muted mb-0">N° Colegios Activos Inscritos</p>
                                        </div>
                                    </div>
                                </div><!-- end card body -->
                            </div>
                        </div><!-- end col -->
                    </div><!-- end row -->

                    <div class="row mt-4">
                        <div class="col-lg-12">
                            <div class="card animate__animated animate__fadeInUp" style="animation-delay: 1s;">
                                <div class="card-body">
                                    <h4 class="card-title">Distribución de Comunas por Región</h4>
                                    <canvas id="comunasChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-xl-4">
                            <div class="card card-height-100">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Top 10 Listas por Costo</h4>
                                    <div class="flex-shrink-0">
                                        <div class="dropdown card-header-dropdown">
                                            <a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="text-muted fs-16"><i class="mdi mdi-dots-vertical align-middle"></i></span>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item" href="#">Más Caras</a>
                                                <a class="dropdown-item" href="#">Más Baratas</a>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end card header -->
                                <div class="card-body">
                                    <div id="listas_costo_chart" class="apex-charts" dir="ltr"></div>
                                    <div class="table-responsive mt-3">
                                        <table class="table table-borderless table-sm table-centered align-middle table-nowrap mb-0">
                                            <tbody class="border-0" id="listas_costo_table">
                                                <!-- Los datos se llenarán con JavaScript -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->
        </div>
        <!-- end main content-->
    </div>
    <!-- END layout-wrapper -->
    <?php include 'layouts/footer.php'; ?>
    <?php include 'layouts/vendor-scripts.php'; ?>
    <!-- App js -->
    <script src="assets/js/app.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const totalRegiones = <?php echo $total_regiones; ?>;
            const totalComunas = <?php echo $total_comunas; ?>;
            const totalColegios = <?php echo $total_colegios; ?>;

            animateCount('regiones-count', totalRegiones);
            animateCount('comunas-count', totalComunas);
            animateCount('colegios-count', totalColegios);

            function animateCount(elementId, target) {
                let count = 0;
                const interval = setInterval(() => {
                    document.getElementById(elementId).textContent = count;
                    if (count >= target) {
                        clearInterval(interval);
                    }
                    count++;
                }, 10);
            }

            createComunasChart();
        });

        function createComunasChart() {
            var ctx = document.getElementById('comunasChart').getContext('2d');
            var comunasChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: [<?php foreach ($chartData as $data) {
                                    echo '"' . $data['nombre_region'] . '",';
                                } ?>],
                    datasets: [{
                        label: 'Número de Comunas',
                        data: [<?php foreach ($chartData as $data) {
                                    echo $data['total_comunas'] . ',';
                                } ?>],
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1,
                                callback: function(value) {
                                    if (Number.isInteger(value)) {
                                        return value;
                                    }
                                }
                            }
                        }
                    }
                }
            });
        }
    </script>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Datos obtenidos de la base de datos
            const listas = [{
                    id_list: 1,
                    grand_total: 150.00
                },
                {
                    id_list: 2,
                    grand_total: 120.00
                },
                {
                    id_list: 3,
                    grand_total: 110.00
                },
                // ... más datos
            ];

            // Preparar datos para ApexCharts
            const chartData = listas.map(lista => lista.grand_total);
            const chartLabels = listas.map(lista => `Lista ${lista.id_list}`);

            // Crear el gráfico con ApexCharts
            var options = {
                series: [{
                    name: 'Total',
                    data: chartData
                }],
                chart: {
                    type: 'bar',
                    height: 350
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '55%',
                        endingShape: 'rounded'
                    },
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    show: true,
                    width: 2,
                    colors: ['transparent']
                },
                xaxis: {
                    categories: chartLabels,
                },
                yaxis: {
                    title: {
                        text: 'Total (USD)'
                    }
                },
                fill: {
                    opacity: 1
                },
                tooltip: {
                    y: {
                        formatter: function(val) {
                            return "$" + val
                        }
                    }
                }
            };

            var chart = new ApexCharts(document.querySelector("#listas_costo_chart"), options);
            chart.render();

            // Llenar la tabla
            const tableBody = document.getElementById('listas_costo_table');
            listas.forEach(lista => {
                const row = document.createElement('tr');
                row.innerHTML = `
            <td><h4 class="text-truncate fs-14 fs-medium mb-0">Lista ${lista.id_list}</h4></td>
            <td><p class="text-muted mb-0">$${lista.grand_total}</p></td>
        `;
                tableBody.appendChild(row);
            });
        });
    </script>


    <!-- apexcharts -->
    <script src="assets/libs/apexcharts/apexcharts.min.js"></script>
    <script src="assets/libs/jsvectormap/js/jsvectormap.min.js"></script>
    <script src="assets/libs/jsvectormap/maps/world-merc.js"></script>

    <!-- projects js -->
    <script src="assets/js/pages/dashboard-projects.init.js"></script>
</body>

</html>