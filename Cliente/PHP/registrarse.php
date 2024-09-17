<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btnRegistrar'])) {
    require_once(__DIR__ . "/../../Admin/PHP/coneccion/conector.php");
    require_once(__DIR__ . "/../../Admin/PHP/Menus/registrarUsuario.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse</title>
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../EstilosMenus/EstilosMenu.css">
    <link rel="stylesheet" href="../EstilosMenus/estilosRegistrase.css">
    <link href="../EstilosMenus/styleLogin.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
</head>
<style>
    .row {
        background-color: currentColor;
        width: auto;
        height: auto;
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

    @media (max-width: 768px) {
        .navbar-nav > li:hover {
            background-color: #0dcaf0;
        }
    }

    .bg {
        background-image: url(login/cbum.jpeg);
        background-position: center center;
    }
</style>

<body>
    <!--MENU START-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <!--NAV CONTAINER start-->
        <div class="container-fluid">
            <a href="MenuPrincipal.html" class="navbar-brand text-info fw-semibold fs-4">SPORTFLEXX</a>

            <!--NAV BUTTON-->
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#menuLateral">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!--OFFCANVAS MAIN CONTAINER START-->
            <section class="offcanvas offcanvas-start" id="menuLateral" tabindex="-1">
                <div class="offcanvas-header" data-bs-theme="dark">
                    <h1 class="canvas-title text-info TituiloMenu ms-5">SPORTFLEXX</h1>
                    <button class="btn-close" type="button" aria-label="close" data-bs-dismiss="offcanvas"></button>
                </div>
                <!--OFFCANVAS MENU LINKS START-->
                <div class="offcanvas-body d-flex flex-column justify-content-between px-0 Presentacion">
                    <ul class="navbar-nav my-2 justify-content-evenly">
                        <li class="nav-item p-3 py-md-1"><a href="hombre.html" class="nav-link">HOMBRE</a></li>
                        <li class="nav-item p-3 py-md-1"><a href="mujer.html" class="nav-link">MUJERES</a></li>
                        <li class="nav-item p-3 py-md-1"><a href="Accesorios.html" class="nav-link">ACCESORIOS</a></li>
                        <li class="nav-item p-3 py-md-1"><a href="oferta.html" class="nav-link">OFERTAS</a></li>
                        <li class="nav-item p-3 py-md-1"><a href="Login.php" class="nav-link"><i class="bi bi-person"></i></a></li>
                        <li class="nav-item p-3 py-md-1"><a href="carritoCompras.html" class="nav-link"><i class="bi bi-cart"></i></a></li> <!--enlace redes sociales-->
                        <div class="d-lg-none align-self-center py-3">
                            <a href=""><i class="bi bi-twitter px-2 text-info fs-2"></i></a>
                            <a href=""><i class="bi bi-facebook px-2 text-info fs-2"></i></a>
                            <a href=""><i class="bi bi-github px-2 text-info fs-2"></i></a>
                            <a href=""><i class="bi bi-whatsapp px-2 text-info fs-2"></i></a>
                        </div>
                    </ul>
                </div>

            </section>
            <!--OFFCANVAS MAIN CONTAINER END-->
        </div>
    </nav>

    <div class="container w-75 bg-primary mt-5 rounded shadow">
        <div class="row align-items-stretch">
            <div class="col bg d-none d-lg-block col-md-5 col-lg-5 col-xl-6 rounded">
                <img src="../ImagenQuienesSomos/imagen2.webp" width="100%" height="100%">
            </div>
            <div class="col bg-white p-5 rounded-end">
                <form class="form" method="POST" action="registrarse.php" autocomplete="off">
                    <p id="heading">Registrarse</p>
                    <div class="field">
                        <span class="material-symbols-outlined">alternate_email</span>
                        <input id="NombreUsuario" name="NombreUsuario" autocomplete="off" placeholder="Nombre de Usuario" class="input-field" type="text" required autofocus />
                    </div>
                    <div class="field">
                        <span class="material-symbols-outlined">email</span>
                        <input id="CorreoElectronico" name="CorreoElectronico" autocomplete="off" placeholder="Correo Electrónico" class="input-field" type="email" required />
                    </div>
                    <div class="field">
                        <span class="material-symbols-outlined">lock_open</span>
                        <input id="Contrasena" placeholder="Contraseña" class="input-field" type="password" name="Contrasena" required />
                    </div>
                    <div class="btn">
                        <button type="submit" class="button1" name="btnRegistrar">Registrarse</button>
                        <a class="button2" href='Login.php'>Login</a>
                    </div>
                    <button class="button3" href="password.html">¿Olvidó su contraseña?</button>
                </form>
            </div>
        </div>
    </div>

    <footer class="mt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <div class="single-box">
                        <h2>AYUDA</h2>
                        <ul>
                            <li><a href="#">Preguntas frecuentes</a></li>
                            <li><a href="#">Informacion de entrega</a></li>
                            <li><a href="#">Politica de devolucion</a></li>
                            <li><a href="#">Hacer una devolucion</a></li>
                            <li><a href="#">Pedidios</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="single-box">
                        <h2>MI CUENTA</h2>
                        <ul>
                            <li><a href="Login.php">Acceso</a></li>
                            <li><a href="registrarse.php">Registro</a></li>

                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="single-box">
                        <h2>PAGINAS</h2>
                        <ul>
                            <li><a href="#">Recomendar un amigo</a></li>
                            <li><a href="QuienesSomos.html">Sobre Nosotros</a></li>
                            <li><a href="#">Carreras</a></li>
                            <li><a href="#">Descuento Estudiantil</a></li>
                            <li><a href="#">Declaracion de accesibilidad</a></li>
                            <li><a href="#">lista de fabrica</a></li>
                            <li><a href="#">Sostenibilidad</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="single-box">
                        <h3>UNETE A LA FAMILIA SPORTFLEXX</h3>
                        <p>Reciba actualizaciones al instante, acceda a ofertas exclusivas, detalles de lanzamiento de
                            productos y mas.</p>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Recipient's username"
                                aria-label="Enter your Email ..." aria-describedby="basic-addon2">
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/js/bootstrap.min.js">
    <!--FIN IMAGENES-->
</body>

</html>
