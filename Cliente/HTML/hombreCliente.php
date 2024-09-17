<?php
// Iniciar sesión para manejar el carrito
session_start();

// Conexión a la base de datos
$conexion = new mysqli('localhost', 'root', '', 'sportflexx');  // Ajusta las credenciales según corresponda

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Consulta para obtener productos de la categoría "HOMBRE"
$sql = "SELECT p.IdProducto, p.Nombre AS nombre_producto, p.PrecioUnitario AS Precio, p.ImagenProducto 
        FROM producto p 
        WHERE p.IdCategoria = 1";  // IdCategoria = 1 para productos de hombre
$resultado = $conexion->query($sql);

// Manejo de la acción "Agregar al carrito"
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['agregar_carrito'])) {
    $producto_id = $_POST['producto_id'];
    $producto_nombre = $_POST['producto_nombre'];
    $producto_precio = $_POST['producto_precio'];

    // Agregar producto al carrito en la sesión
    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = [];
    }

    $_SESSION['carrito'][] = [
        'id' => $producto_id,
        'nombre' => $producto_nombre,
        'precio' => $producto_precio,
        'cantidad' => 1 // Por defecto, agregar un solo producto
    ];

    echo "<p>Producto agregado al carrito!</p>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>HOMBRE</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"/>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"/>
  <link rel="stylesheet" href="../EstilosMenus/EstilosMenu.css"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
</head>

<body>
  <!--MENÚ DE NAVEGACIÓN-->
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
            <li class="nav-item p-3 py-md-1"><a href="hombreCliente.php" class="nav-link">HOMBRE</a></li>
            <li class="nav-item p-3 py-md-1"><a href="mujerCliente.php" class="nav-link">MUJERES</a></li>
            <li class="nav-item p-3 py-md-1"><a href="AccesoriosCliente.php" class="nav-link">ACCESORIOS</a></li>
            <li class="nav-item p-3 py-md-1"><a href="ofertaCliente.php" class="nav-link">OFERTAS</a></li>
            <li class="nav-item p-3 py-md-1"><a href="carritoCliente.php" class="nav-link"><i class="bi bi-cart"></i></a></li>
            <li class="nav-item dropdown p-3 py-md-1">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-user-circle"></i> Mi Cuenta
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="MiPerfil.php"><i class="fas fa-cog"></i> Perfil</a>
                <a class="dropdown-item" href="Logout.php"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a>
              </div>
            </li>
          </ul>
        </div>
      </section>
    </div>
  </nav>

  <!-- Productos dinámicos desde la base de datos -->
  <div class="titulo">
    <div class="container">
      <h3 class="text-left my-2">HOMBRE</h3>
      <div class="row row-cols-1 row-cols-md-3 g-4 py-5">
        <?php
        // Mostrar productos dinámicamente
        if ($resultado->num_rows > 0) {
            while ($producto = $resultado->fetch_assoc()) {
                // Ruta base para las imágenes
                $ruta_base = "http://localhost/SPORTFLEXX4.1/Cliente/ImagenProductos/Hombres/";
                
                echo "<div class='col'>";
                echo "<div class='card'>";
                echo "<img src='" . $ruta_base . $producto['ImagenProducto'] . "' class='card-img-top' alt='" . $producto['nombre_producto'] . "' style='width: 100%; height: auto; object-fit: cover;'>";
                echo "<div class='card-body'>";
                echo "<h5 class='card-title'>" . $producto['nombre_producto'] . "</h5>";
                echo "<p class='card-text'>Precio: S/" . $producto['Precio'] . "</p>";
                echo "<form method='POST' action='hombreCliente.php'>";
                echo "<input type='hidden' name='producto_id' value='" . $producto['IdProducto'] . "'>";
                echo "<input type='hidden' name='producto_nombre' value='" . $producto['nombre_producto'] . "'>";
                echo "<input type='hidden' name='producto_precio' value='" . $producto['Precio'] . "'>";
                echo "<button type='submit' class='btn btn-primary' name='agregar_carrito'>Añadir al Carrito</button>";
                echo "</form>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "<p>No se encontraron productos para hombre.</p>";
        }
        ?>
      </div>
    </div>
  </div>

  <footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-sm-6"><div class="single-box"><h2>AYUDA</h2></div></div>
            <div class="col-lg-3 col-sm-6"><div class="single-box"><h2>MI CUENTA</h2></div></div>
            <div class="col-lg-3 col-sm-6"><div class="single-box"><h2>PÁGINAS</h2></div></div>
            <div class="col-lg-3 col-sm-6"><div class="single-box"><h3>ÚNETE A LA FAMILIA SPORTFLEXX</h3></div></div>
        </div>
    </div>
  </footer>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="carrito-common.js"></script>
<script src="carritoCliente.js"></script>
</html>

<?php $conexion->close(); ?>
