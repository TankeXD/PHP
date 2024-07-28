<section id="inicio">
    <div class="container mt-5">
        <!-- empieza nav tipo topbar -->
        <nav class="navbar navbar-expand-lg navbar-light fixed-top">
            <div class="container">
                <a class="navbar-brand text-white">Mi Colegio</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarContent">
                    <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="#inicio">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="view/Product/products.php">Nuestros Productos</a>
                        </li>
                    </ul>
                    <div class="d-flex align-items-center">
                        <a href="view/Login/login.php" class="btn btn-link text-white me-3">Iniciar Sesión</a>
                        <a href="view/Client/check-in.php" class="btn btn-custom">Registrarse</a>
                        <div class="social-icons ms-3">
                            <a href="#"><i class="mdi mdi-facebook"></i></a>
                            <a href="#"><i class="mdi mdi-twitter"></i></a>
                            <a href="#"><i class="mdi mdi-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <!-- termina nav tipo topbar -->

        <!-- empieza slider -->
        <div class="card-body">
            <div class="live-preview">
                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
                    </div>
                    <div class="carousel-inner" role="listbox">
                        <div class="carousel-item active">
                            <img class="d-block img-fluid mx-auto" src="assets/images/index/fondos/fondo1.jpg" alt="First slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block img-fluid mx-auto" src="assets/images/index/fondos/fondo2.jpg" alt="Second slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block img-fluid mx-auto" src="assets/images/index/fondos/fondo3.jpg" alt="Third slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block img-fluid mx-auto" src="assets/images/index/fondos/fondo4.jpg" alt="Fourth slide">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- termina slider -->

        <!-- empiezan cards -->
        <section id="productos">
            <h1 class="mt-5 text-center titles"><i>Categorías Disponibles</i></h1>
            <div class="row g-4 mt-5">
                <!-- Simple card -->
                <div class="col-sm-6 col-xl-3">
                    <a href="view/Product/maintenance-page.php" class="card-link">
                        <div class="card product-card">
                            <img class="card-img-top img-fluid" src="assets/images/index/categorias/escritura 2.png" alt="Card image cap">
                            <div class="card-body">
                                <h4 class="card-title mb-2 titles"><b>ESCRITURA</b></h4>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <a href="view/Product/maintenance-page.php" class="card-link">
                        <div class="card product-card">
                            <img class="card-img-top img-fluid" src="assets/images/index/categorias/escolar.png" alt="Card image cap">
                            <div class="card-body">
                                <h4 class="card-title mb-2 titles"><b>HERRAMIENTAS DE MEDIR</b></h4>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <a href="view/Product/maintenance-page.php" class="card-link">
                        <div class="card product-card">
                            <img class="card-img-top img-fluid" src="assets/images/index/categorias/arte 2.png" alt="Card image cap">
                            <div class="card-body">
                                <h4 class="card-title mb-2 titles"><b>ARTE</b></h4>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <a href="view/Product/maintenance-page.php" class="card-link">
                        <div class="card product-card">
                            <img class="card-img-top img-fluid" src="assets/images/index/categorias/cuadernos.png" alt="Card image cap">
                            <div class="card-body">
                                <h4 class="card-title mb-2 titles"><B>CUADERNOS</B></h4>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <a href="view/Product/maintenance-page.php" class="card-link">
                        <div class="card product-card">
                            <img class="card-img-top img-fluid" src="assets/images/index/categorias/lapiceria.png" alt="Card image cap">
                            <div class="card-body">
                                <h4 class="card-title mb-2 titles"><B>LAPICERÍA</B></h4>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <a href="view/Product/maintenance-page.php" class="card-link">
                        <div class="card product-card">
                            <img class="card-img-top img-fluid" src="assets/images/index/categorias/papeleria.png" alt="Card image cap">
                            <div class="card-body">
                                <h4 class="card-title mb-2 titles"><B>PAPELERÍA</B></h4>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <a href="view/Product/maintenance-page.php" class="card-link">
                        <div class="card product-card">
                            <img class="card-img-top img-fluid" src="assets/images/index/categorias/archivador.png" alt="Card image cap">
                            <div class="card-body">
                                <h4 class="card-title mb-2 titles"><B>ARCHIVAR</B></h4>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <a href="view/Product/maintenance-page.php" class="card-link">
                        <div class="card product-card">
                            <img class="card-img-top img-fluid" src="assets/images/index/categorias/calculadora.png" alt="Card image cap">
                            <div class="card-body">
                                <h4 class="card-title mb-2 titles"><B>TECNOLOGÍA</B></h4>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </section>
        <!-- terminan cards -->
        <!-- Nuevo apartado de medio de pago -->
        <section id="pago" class="mt-5">
            <div>
                <h2 class="text-center titles"><i>Métodos de Pago</i></h2>
                <div class="d-flex justify-content-center align-items-center mt-3">
                    <img src="assets/images/index/medio de pago.jpg" alt="Medios de Pago" class="img-fluid me-4" style="max-width: 500px;">
                    <img src="assets/images/index/logo2.png" alt="Logo de la Página" class="img-fluid" style="max-width: 400px;">
                </div>
            </div>
        </section>
        <!-- Fin del nuevo apartado de medio de pago -->
    </div>
</section>