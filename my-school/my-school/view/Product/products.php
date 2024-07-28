<!DOCTYPE html>
<html lang="es">
<?php include '../../layouts/main.php'; ?>

<head>
    <?php includeFileWithVariables('../../layouts/title-meta.php', array('title' => 'Nuestros Productos')); ?>
    <?php include '../../layouts/head2.php'; ?>
    <!-- Slick Carousel CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" />
    <!-- Font Awesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <style>
        /* color de fondo */
        body {
            background-color: rgba(215, 255, 255, 0.9);
           
        }

        .slick-prev,
        .slick-next {
            background-color: #007bff;
            color: #fff;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            display: flex !important;
            align-items: center;
            justify-content: center;
            font-size: 14px;
        }

        .slick-prev:hover,
        .slick-next:hover {
            background-color: #0056b3;
        }

        .card-body {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 10px;
            background-color: #fff;
            width: 100%;
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
            color: #ffdd57 !important;
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
            color: #ffdd57;
        }

        .marca-title {
            text-align: center;
            color: darkblue;
        }

        /* estilos para el navbar privado de clientes el sidebar_index */
        #scrollbar .navbar-nav .nav-link:hover {
            color: #ffdd57 !important;
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

        .img-fixed {
            width: 150px;
            height: 150px;
            object-fit: cover;
        }
    </style>
</head>

<body>
    <div id="layout-wrapper" class="d-flex flex-column">
        <div class="page-content">
            <div class="container-fluid">
                <nav class="navbar navbar-expand-lg navbar-light fixed-top">
                    <div class="container">
                        <a class="navbar-brand text-white" href="../../index.php">Mi Sitio</a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarContent">
                            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                                <li class="nav-item">
                                    <a class="nav-link" href="../../index.php">Inicio</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="view/Product/products.php">Nuestros Productos</a>
                                </li>
                            </ul>
                            <div class="d-flex align-items-center">
                                <a href="../Login/login.php" class="btn btn-link text-white me-3">Iniciar Sesión</a>
                                <a href="../Client/check-in.php" class="btn btn-custom">Registrarse</a>
                                <div class="social-icons ms-3">
                                    <a href="#"><i class="mdi mdi-facebook"></i></a>
                                    <a href="#"><i class="mdi mdi-twitter"></i></a>
                                    <a href="#"><i class="mdi mdi-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>

                <?php
                include_once '../../layouts/config.php';
                $connect = connection();

                $sql_marcas_productos = "SELECT m.nombre_marca, p.nombre_prod, p.ruta_img, p.precio_prod FROM marcas m INNER JOIN producto p ON m.id_marca = p.id_marca ORDER BY m.nombre_marca";
                $result_marcas_productos = $connect->query($sql_marcas_productos);

                $productos_por_marca = array();

                if ($result_marcas_productos->num_rows > 0) {
                    while ($row = $result_marcas_productos->fetch_assoc()) {
                        $marca = $row['nombre_marca'];
                        $producto = array(
                            'nombre_prod' => $row['nombre_prod'],
                            'ruta_img' => $row['ruta_img'],
                            'precio_prod' => $row['precio_prod']
                        );

                        if (!isset($productos_por_marca[$marca])) {
                            $productos_por_marca[$marca] = array();
                        }
                        $productos_por_marca[$marca][] = $producto;
                    }

                    foreach ($productos_por_marca as $marca => $productos) {
                ?>
                        <div class="row justify-content-center">
                            <div class="col-12">
                                <h2 class="marca-title">Productos de la marca <?php echo $marca; ?></h2>
                                <div class="slick-carousel slick-<?php echo $marca; ?>">
                                    <?php foreach ($productos as $producto) { ?>
                                        <div>
                                            <div class="card card-body">
                                                <div class="mb-4 text-center">
                                                    <img src="<?php echo $producto['ruta_img']; ?>" alt="" class="img-fluid rounded img-fixed" />
                                                </div>
                                                <h5 class="card-title text-center mb-1"><?php echo $producto['nombre_prod']; ?></h5>
                                                <h6 class="text-center mb-1">$<?php echo $producto['precio_prod']; ?> / unidad</h6>
                                                <p class="card-text text-muted text-center">Precio por unidad</p>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                } else {
                    ?>
                    <p>No hay productos disponibles para ninguna marca.</p>
                <?php
                }

                $connect->close();
                ?>

                <div class="row" style="display: none;">
                    <div class="col-4">
                        <div class="form-check card-radio">
                            <input id="customizer-layout02" name="data-layout" type="radio" value="horizontal" checked>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <?php include '../../layouts/footer_index.php'; ?>

    <?php include '../../layouts/vendor-scripts 2.php'; ?>
    <script src="../../assets/js/app.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.slick-carousel').slick({
                infinite: true,
                slidesToShow: 3,
                slidesToScroll: 1,
                prevArrow: '<div class="slick-prev"></div>',
                nextArrow: '<div class="slick-next"></div>',
                responsive: [{
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
                ]
            });
        });
    </script>
</body>

</html>