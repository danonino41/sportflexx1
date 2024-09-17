<?php
session_start();


require_once(__DIR__ . "/../../Admin/PHP/coneccion/conector.php");
$obj = new Conectar();
$conexion = $obj->getConexion();

$menus = obtenerMenusPorRol(2, $conexion);

function obtenerMenusPorRol($idRol, $conexion)
{
    $query = "SELECT MENU.Nombre, MENU.Ruta
            FROM MENU
            INNER JOIN ROLMENU ON MENU.IdMenu = ROLMENU.IdMenu
            WHERE ROLMENU.IdRol = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("i", $idRol);
    $stmt->execute();
    $result = $stmt->get_result();
    $menus = [];

    while ($row = $result->fetch_assoc()) {
        $menus[] = $row;
    }

    $stmt->close();
    return $menus;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SPORTFLEXX</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../EstilosMenus/EstilosMenu.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/js/bootstrap.min.js" />
</head>
<style>
    .carousel-item img,
    .carousel-item video {
        width: 100%;
        height: 80vh;
        object-fit: cover;
    }

    .carousel-caption {
        bottom: 20%;
    }

    nav,
    .offcanvas {
        background-color: #1e293b;
    }

    .navbar-toggler {
        border: none;
    }

    .navbar-toggler:focus {
        outline: none;
        box-shadow: none;
    }

    @media (max-wiidth: 768px) {
        .navbar-nav>li:hover {
            background-color: #0dcaf0;
        }
    }
</style>

<body>

    <!-- MENU START -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a href="MenuPrincipalCliente.php" class="navbar-brand text-info fw-semibold fs-4">SPORTFLEXX</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#menuLateral">
                <span class="navbar-toggler-icon"></span>
            </button>
            <section class="offcanvas offcanvas-start" id="menuLateral" tabindex="-1">
                <div class="offcanvas-header">
                    <h1 class="canvas-title text-info TituiloMenu ms-5">SPORTFLEXX</h1>
                    <button class="btn-close" type="button" aria-label="close" data-bs-dismiss="offcanvas"></button>
                </div>
                <div class="offcanvas-body d-flex flex-column justify-content-between px-0 Presentacion">
                    <ul class="navbar-nav my-2 justify-content-evenly">
                        <li class="nav-item p-3 py-md-1">
                            <a href="hombreCliente.html" class="nav-link">HOMBRE</a>
                        </li>
                        <li class="nav-item p-3 py-md-1">
                            <a href="mujerCliente.html" class="nav-link">MUJERES</a>
                        </li>
                        <li class="nav-item p-3 py-md-1">
                            <a href="AccesoriosCliente.html" class="nav-link">ACCESORIOS</a>
                        </li>
                        <li class="nav-item p-3 py-md-1">
                            <a href="ofertaCliente.html" class="nav-link">OFERTAS</a>
                        </li>
                        <li class="nav-item p-3 py-md-1">
                            <a href="carritoCliente.html" class="nav-link" target="_blank" rel="noopener noreferrer"><i class="bi bi-cart"></i></a>
                        </li>
                        <li class="nav-item dropdown p-3 py-md-1">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-user-circle"></i> Mi Cuenta
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="MiPerfil.php"><i class="fas fa-cog"></i> Perfil</a>

                                <a class="dropdown-item" href="Logout.php"><i class="fas fa-sign-out-alt"></i> Cerrar
                                    Sesión</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </section>
        </div>
    </nav>

    <!-- IMÁGENES -->
    <div class="container-fluid p-0">
        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active" data-bs-interval="5000">
                    <video class="video-fluid w-100" autoplay loop muted>
                        <source src="../ImagenMenu/LOOK_5_-_Web_Banner_-_April_Key_Looks_-_16x9.mp4" type="video/mp4">
                    </video>
                    <div class="carousel-caption d-none d-md-block">
                        <h2 class="text-warning fw-bold">Nature with sea</h2>
                        <button type="button" class="btn btn-warning btn-lg mt-3 text-white">Learn More</button>
                    </div>
                </div>
                <div class="carousel-item " data-bs-interval="5000">
                    <img src="../ImagenMenu/image.png" class="d-block w-100" alt="Nature with sea">
                    <div class="carousel-caption d-none d-md-block">
                        <h2 class="text-warning fw-bold">Nature with sea</h2>
                        <button type="button" class="btn btn-warning btn-lg mt-3 text-white">Learn More</button>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

    <div class="container">
        <!-- Productos Hombres -->
        <div class="row">
            <div class="col-12">
                <h3 class="text-left my-2">HOMBRES</h3>
                <a href="hombreCliente.html">
                    <h4 class="text-left">ver todo</h4>
                </a>
            </div>
        </div>
        <div class="row row-cols-1 row-cols-md-3 g-4 py-5">
            <div class="col">
                <div class="card">
                    <img src="../Imagenproductos/Hombres/Polo Manga Corta Rubi.png" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">475 SUPERVILLAIN</h5>
                        <p class="card-text">
                            COMPRESSION TEES
                            AZUL PETROLIO
                        </p>
                        <p class="precio">S/70.00</p>
                        <div>
                            <button class="btn btn-primary add-to-cart" data-producto-id="1" data-producto-name="475 SUPERVILLAIN" data-producto-price="70.00" data-producto-image="../Imagenproductos/Hombres/image1.png">Añadir al carrito</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <img src="../Imagenproductos/Hombres/Polo Manga Corta.png" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">RIBBED TANK 1PK</h5>
                        <p class="card-text">
                            AJUSTE MUSCULAR
                            BLANCO
                        </p>
                        <p class="precio">S/50.00
                        <p>
                        <div>
                            <button class="btn btn-primary add-to-cart" data-producto-id="2" data-producto-name="475 SUPERVILLAIN" data-producto-price="70.00" data-producto-image="../Imagenproductos/Hombres/image2.png">Añadir al carrito</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <img src="../Imagenproductos/Hombres/Polo Manga Larga.png" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">CASACA ADIDAS</h5>
                        <p class="card-text">
                            COLOR CLASSICS
                            AZUL
                        </p>
                        <p class="precio">S/270.00
                        <p>
                        <div>
                            <button class="btn btn-primary add-to-cart" data-producto-id="3" data-producto-name="475 SUPERVILLAIN" data-producto-price="70.00" data-producto-image="../Imagenproductos/Hombres/image3.png">Añadir al carrito</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Productos Mujeres -->
        <div class="row">
            <div class="col-12">
                <h3 class="text-left my-2">MUJER</h3>
                <a href="mujerCliente.html">
                    <h4 class="text-left">ver todo</h4>
                </a>
            </div>
        </div>
        <div class="row row-cols-1 row-cols-md-3 g-4 py-5">
            <div class="col">
                <div class="card">
                    <img src="../ImagenProductos/Mujeres/image1.png" class="card-img-top" alt="..." />
                    <div class="card-body">
                        <h5 class="card-title">475 SUPERVILLAIN</h5>
                        <p class="card-text">COMPRESSION TEES AZUL PETROLIO</p>
                        <p class="precio">S/70.00</p>
                        <div>
                            <button class="btn btn-primary add-to-cart" data-producto-id="10" data-producto-name="475 SUPERVILLAIN" data-producto-price="70.00" data-producto-image="../ImagenProductos/Mujeres/image1.png">Añadir al carrito</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <img src="../ImagenProductos/Mujeres/image2.png" class="card-img-top" alt="..." />
                    <div class="card-body">
                        <h5 class="card-title">RIBBED TANK 1PK</h5>
                        <p class="card-text">AJUSTE MUSCULAR BLANCO</p>
                        <p class="precio">S/50.00</p>
                        <div>
                            <button class="btn btn-primary add-to-cart" data-producto-id="11" data-producto-name="475 SUPERVILLAIN" data-producto-price="70.00" data-producto-image="../ImagenProductos/Mujeres/image2.png">Añadir al carrito</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <img src="../ImagenProductos/Mujeres/image3.png" class="card-img-top" alt="..." />
                    <div class="card-body">
                        <h5 class="card-title">CASACA ADIDAS</h5>
                        <p class="card-text">COLOR CLASSICS AZUL</p>
                        <p class="precio">S/270.00</p>
                        <div>
                            <button class="btn btn-primary add-to-cart" data-producto-id="12" data-producto-name="475 SUPERVILLAIN" data-producto-price="70.00" data-producto-image="../ImagenProductos/Mujeres/image3.png">Añadir al carrito</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Productos Accesorios -->
        <div class="row">
            <div class="col-12">
                <h3 class="text-left my-2">ACCESORIOS</h3>
                <a href="AccesoriosCliente.html">
                    <h4 class="text-left">ver todo</h4>
                </a>
            </div>
        </div>
        <div class="row row-cols-1 row-cols-md-3 g-4 py-5">
            <div class="col">
                <div class="card">
                    <img src="../ImagenProductos/accesorios/image1.png" class="card-img-top" alt="..." />
                    <div class="card-body">
                        <h5 class="card-title">475 SUPERVILLAIN</h5>
                        <p class="card-text">COMPRESSION TEES AZUL PETROLIO</p>
                        <a>S/70.00</a>
                        <div>
                            <button class="btn btn-primary add-to-cart" data-producto-id="19" data-producto-name="475 SUPERVILLAIN" data-producto-price="70.00" data-producto-image="../ImagenProductos/accesorios/image1.png">Añadir al carrito</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <img src="../ImagenProductos/accesorios/image2.png" class="card-img-top" alt="..." />
                    <div class="card-body">
                        <h5 class="card-title">RIBBED TANK 1PK</h5>
                        <p class="card-text">AJUSTE MUSCULAR BLANCO</p>
                        <a>S/50.00</a>
                        <div>
                            <button class="btn btn-primary add-to-cart" data-producto-id="20" data-producto-name="475 SUPERVILLAIN" data-producto-price="70.00" data-producto-image="../ImagenProductos/accesorios/image2.png">Añadir al carrito</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <img src="../ImagenProductos/accesorios/image3.png" class="card-img-top" alt="..." />
                    <div class="card-body">
                        <h5 class="card-title">CASACA ADIDAS</h5>
                        <p class="card-text">AJUSTE MUSCULAR BLANCO</p>
                        <a>S/270.00</a>
                        <div>
                            <button class="btn btn-primary add-to-cart" data-producto-id="21" data-producto-name="475 SUPERVILLAIN" data-producto-price="70.00" data-producto-image="../ImagenProductos/accesorios/image3.png">Añadir al carrito</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Productos Ofertas -->
        <div class="row">
            <div class="col-12">
                <h3 class="text-left my-2">OFERTAS</h3>
                <a href="ofertaCliente.html">
                    <h4 class="text-left">ver todo</h4>
                </a>
            </div>
        </div>
        <div class="row row-cols-1 row-cols-md-3 g-4 py-5">
            <div class="col">
                <div class="card">
                    <img src="../ImagenProductos/Oferta/image1.png" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">475 SUPERVILLAIN</h5>
                        <p class="card-text">
                            COMPRESSION TEES
                            AZUL PETROLIO
                        </p>
                        <a>S/70.00</a>
                        <div>
                            <button class="btn btn-primary add-to-cart" data-producto-id="28" data-producto-name="475 SUPERVILLAIN" data-producto-price="70.00" data-producto-image="../ImagenProductos/Oferta/image1.png">Añadir al carrito</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <img src="../ImagenProductos/Oferta/image2.png" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">RIBBED TANK 1PK</h5>
                        <p class="card-text ">
                            AJUSTE MUSCULAR
                            BLANCO
                        </p>
                        <a>S/50.00</a>
                        <div>
                            <button class="btn btn-primary add-to-cart" data-producto-id="29" data-producto-name="475 SUPERVILLAIN" data-producto-price="70.00" data-producto-image="../ImagenProductos/Oferta/image2.png">Añadir al carrito</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <img src="../ImagenProductos/Oferta/image3.png" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">CASACA ADIDAS</h5>
                        <p class="card-text">
                            COLOR CLASSICS
                            AZUL PETROLIO
                        </p>
                        <a>S/270.00</a>
                        <div>
                            <button class="btn btn-primary add-to-cart" data-producto-id="30" data-producto-name="475 SUPERVILLAIN" data-producto-price="70.00" data-producto-image="../ImagenProductos/Oferta/image3.png">Añadir al carrito</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <div class="single-box">
                        <h2>AYUDA</h2>
                        <ul>
                            <li><a href="preguntasFrecuentes.html">Preguntas frecuentes</a></li>
                            <li><a href="informacionEntrega.html">Informacion de entrega</a></li>
                            <li><a href="#">Politica de devolucion</a></li>
                        <!--<li><a href="#">Hacer una devolucion</a></li>-->
                        <!--<li><a href="#">Pedidios</a></li>--> 
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="single-box">
                        <h2>MI CUENTA</h2>
                        <ul>
                            <li><a href="../PHP/Login2.php">Acceso</a></li>
                            <li><a href="../PHP/registrarse.php">Registro</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="single-box">
                        <h2>PAGINAS</h2>
                        <ul>
                            <li><a href="QuienesSomos.html">Quienes somos</a></li>
                            <li><a href="#">Recomendar un amigo</a></li>
                        <!--<li><a href="#">Carreras</a></li>-->
                        <!--<li><a href="#">Descuento Estudiantil</a></li>-->
                            <li><a href="#">Declaracion de accesibilidad</a></li>
                            <li><a href="#">lista de fabrica</a></li>
                            <li><a href="#">Sostenibilidad</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="single-box">
                        <h3>UNETE A LA FAMILIA SPORTFLEXX</h3>
                        <p>
                            Reciba actualizaciones al instante, acceda a ofertas exclusivas,
                            detalles de lanzamiento de productos y mas.
                        </p>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Recipient's username"
                                aria-label="Enter your Email ..." aria-describedby="basic-addon2" />
                            <span class="input-group-text" id="basic-addon2"><i
                                    class="fa fa-long-arrow-right"></i></span>
                        </div>
                        <h2>Síguenos en</h2>
                        <p class="socials">
                            <a href="https://www.facebook.com/"><i class="fa fa-facebook"></i></a>
                            <a href="https://www.instagram.com/"><i class="fa fa-instagram"></i></a>
                            <a href="https://www.pinterest.com/"><i class="fa fa-pinterest"></i></a>
                            <a href="https://twitter.com/"><i class="fa fa-twitter"></i></a>
                        </p>
                        <div class="card-area">
                            <i class="fa fa-cc-visa"></i>
                            <i class="fa fa-credit-card"></i>
                            <i class="fa fa-cc-mastercard"></i>
                            <i class="fa fa-cc-paypal"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!--FIN IMAGENES-->
</body>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
    crossorigin="anonymous"></script>
<script src="carrito-common.js"></script>
<script src="carritoCliente.js"></script>

</html>