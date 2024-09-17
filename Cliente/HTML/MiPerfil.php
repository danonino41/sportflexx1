<?php
require_once(__DIR__ . "/../../Admin/PHP/coneccion/conector.php");

session_start();
if (!isset($_SESSION['IdUsuario'])) {
    header("Location: ../PHP/login2.php");
    exit();
}

$IdUsuario = $_SESSION['IdUsuario'];

$obj = new Conectar();
$conexion = $obj->getConexion();

$sql = "SELECT cliente.*, usuario.NombreUsuario, usuario.CorreoElectronico, usuario.Contrasena,
                direccion.IdDireccion, direccion.Departamento, direccion.Provincia, direccion.Distrito, direccion.Direccion 
        FROM cliente 
        INNER JOIN usuario ON cliente.IdUsuario = usuario.IdUsuario 
        INNER JOIN direccion ON cliente.IdCliente = direccion.IdCliente
        WHERE cliente.IdUsuario = ?";

$stmt = mysqli_prepare($conexion, $sql);
mysqli_stmt_bind_param($stmt, "i", $IdUsuario);
mysqli_stmt_execute($stmt);
$resultado = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($resultado);

mysqli_stmt_close($stmt);
mysqli_close($conexion);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Perfil</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../EstilosMenus/EstilosMenu.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<!--<link href="../../Admin/PHP/estilos/stylesProducto.css" rel="stylesheet" />
    <link href="../../Admin/PHP/estilos/stylesAdmin.css" rel="stylesheet" /> -->
    <style>
body {
    background-color: #f8f9fa;
    height: 100vh;
    display: flex;
    flex-direction: column;
}

nav,
.offcanvas {
    background-color: #1e293b;
}

.navbar-brand {
    font-size: 1.5rem;
    font-weight: bold;
}

.MarcodeCaja {
    flex: 1;
    margin: 0 auto;
    padding: 20px;
    max-width: 900px;
    height: auto; /* Cambiamos de fijo a auto para ajustarse dinámicamente */
    padding-bottom: 100px; /* Añadimos espacio para que el contenido no quede pegado al footer */
}

.page-title {
    color: #343a40;
    font-size: 2rem;
    font-weight: bold;
    text-align: center;
}

.profile-card {
    box-shadow: none; /* Eliminamos la sombra de la tarjeta */
    border: none; /* Eliminamos los bordes */
}

.profile-img {
    border-radius: 50%;
    max-width: 100%; /* Asegurar que la imagen no se desborde */
    height: auto; /* Mantener proporciones */
    margin-bottom: 10px; /* Espacio debajo de la imagen */
}

.form-control {
    border: none;
    border-bottom: 1px solid #ced4da;
    border-radius: 0;
    background-color: #f9f9f9;
    padding: 10px;
}

.form-control:focus {
    border-bottom-color: #0dcaf0;
    background-color: #ffffff; /* Fondo blanco cuando esté enfocado */
    box-shadow: 0 0 0 0.2rem rgba(13, 202, 240, 0.25);
}

.col-lg-8.col-xlg-9 {
    overflow-y: auto; /* Habilita el scroll solo en esta sección */
    padding-right: 15px; /* Espacio extra para mejor scroll */
    padding-left: 15px; /* Ajustar el padding al borde */
}

.form-horizontal .row {
    display: flex;
    align-items: center;
    margin-bottom: 15px; /* Espacio entre filas */
}

.form-horizontal label {
    flex: 0 0 25%; /* Tamaño fijo para las etiquetas */
    max-width: 25%;
    padding-right: 15px; /* Espacio entre el label y el campo */
    text-align: right; /* Alinear texto a la derecha */
    font-weight: bold; /* Poner en negrita las etiquetas */
    color: #343a40; /* Color oscuro para un mejor contraste */
}

.form-horizontal .col-md-9 {
    flex: 0 0 75%; /* Tamaño fijo para los campos */
    max-width: 75%;
}

button {
    background-color: #0dcaf0;
    border: none;
    padding: 10px 20px;
    color: white;
    font-weight: bold;
    border-radius: 5px;
    cursor: pointer;
}

button:hover {
    background-color: #0bb4cc;
}

footer {
    background-color: #343a40;
    color: white;
    text-align: center;
    padding: 15px;
    position: relative;
    bottom: 0;
    width: 100%;
    margin-top: 20px; /* Espacio entre el contenido y el footer */
}

.social-media a {
    color: white;
    margin: 0 10px;
    font-size: 1.5rem;
    transition: color 0.3s ease;
}

.social-media a:hover {
    color: #0dcaf0;
}

    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a href="MenuPrincipalCliente.php" class="navbar-brand text-info fw-semibold fs-4">SPORTFLEXX</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#menuLateral">
                <span class="navbar-toggler-icon"></span>
            </button>
            <section class="offcanvas offcanvas-start" id="menuLateral" tabindex="-1">
                <div class="offcanvas-header" data-bs-theme="dark">
                    <h1 class="canvas-title text-info TituiloMenu ms-5">SPORTFLEXX</h1>
                    <button class="btn-close" type="button" aria-label="close" data-bs-dismiss="offcanvas"></button>
                </div>
                <div class="offcanvas-body d-flex flex-column justify-content-between px-0 Presentacion">
                    <ul class="navbar-nav my-2 justify-content-evenly">
                        <li class="nav-item p-3 py-md-1"><a href="MiPerfil.php" class="nav-link">Mi Perfil</a></li>
                        <!--<li class="nav-item p-3 py-md-1"><a href="MisProductos.html" class="nav-link">Mis Productos</a></li>
                        <li class="nav-item p-3 py-md-1"><a href="MisCompras.html" class="nav-link">Mis Compras</a></li>-->
                        <li class="nav-item dropdown p-3 py-md-1">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="MiPerfil.php"><i class="fas fa-cog"></i> Perfil</a>

                                <a class="dropdown-item" href="Logout.php"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a>
                            </ul>
                        </li>
                        <div class="d-lg-none align-self-center py-3">
                            <a href=""><i class="bi bi-twitter px-2 text-info fs-2"></i></a>
                            <a href=""><i class="bi bi-facebook px-2 text-info fs-2"></i></a>
                            <a href=""><i class="bi bi-github px-2 text-info fs-2"></i></a>
                            <a href=""><i class="bi bi-whatsapp px-2 text-info fs-2"></i></a>
                        </div>
                    </ul>
                </div>
            </section>
        </div>
    </nav>

    <!-- Cuerpo -->
    <div class="MarcodeCaja">
        <div class="page-wrapper">
            <div class="container-fluid">
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h3 class="text-themecolor">Mi Perfil</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-xlg-3">
                        <div class="card">
                            <div class="card-body">
                                <center class="m-t-30">
                                    <img src="../ImagenQuienesSomos/imagen3.jpg" class="img-circle" width="130" />
                                    <h4 class="card-subtitle mt-2">Cliente</h4>
                                </center>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-xlg-9">
                        <div class="card">
                            <div class="card-body">
                                <?php if ($row) { ?>
                                    <form class="form-horizontal form-material mx-2" id="profileForm">

                                        <div class="row mb-3">
                                            <label for="editNombreUsuario" class="col-md-3 col-form-label">Nombre
                                                Usuario:</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" id="editNombreUsuario"
                                                    name="NombreUsuario" value="<?php echo $row['NombreUsuario']; ?>"
                                                    readonly>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="editCorreoElectronico" class="col-md-3 col-form-label">Correo
                                                Electrónico:</label>
                                            <div class="col-md-9">
                                                <input type="email" class="form-control" id="editCorreoElectronico"
                                                    name="CorreoElectronico"
                                                    value="<?php echo $row['CorreoElectronico']; ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="editContrasena" class="col-md-3 col-form-label">Contraseña:</label>
                                            <div class="col-md-9">
                                                <input type="password" class="form-control" id="editContrasena"
                                                    name="Contrasena" value="<?php echo $row['Contrasena']; ?>" readonly>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="editNombre" class="col-md-3 col-form-label">Nombre:</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" id="editNombre" name="Nombre"
                                                    value="<?php echo $row['Nombre']; ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="editApellido" class="col-md-3 col-form-label">Apellido:</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" id="editApellido" name="Apellido"
                                                    value="<?php echo $row['Apellido']; ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="editSexo" class="col-md-3 col-form-label">Sexo:</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" id="editSexo" name="Sexo"
                                                    value="<?php echo $row['Sexo']; ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="editFechaNacimiento" class="col-md-3 col-form-label">Fecha de
                                                Nacimiento:</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" id="editFechaNacimiento"
                                                    name="FechaNacimiento" value="<?php echo $row['FechaNacimiento']; ?>"
                                                    readonly>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="editTelefono" class="col-md-3 col-form-label">Teléfono:</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" id="editTelefono" name="Telefono"
                                                    value="<?php echo $row['Telefono']; ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="editDni" class="col-md-3 col-form-label">DNI:</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" id="editDni" name="Dni"
                                                    value="<?php echo $row['Dni']; ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="editIdDireccion" class="col-md-3 col-form-label">ID
                                                Dirección:</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" id="editIdDireccion"
                                                    name="IdDireccion" value="<?php echo $row['IdDireccion']; ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="editDepartamento"
                                                class="col-md-3 col-form-label">Departamento:</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" id="editDepartamento"
                                                    name="Departamento" value="<?php echo $row['Departamento']; ?>"
                                                    readonly>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="editProvincia" class="col-md-3 col-form-label">Provincia:</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" id="editProvincia" name="Provincia"
                                                    value="<?php echo $row['Provincia']; ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="editDistrito" class="col-md-3 col-form-label">Distrito:</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" id="editDistrito" name="Distrito"
                                                    value="<?php echo $row['Distrito']; ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="editDireccion" class="col-md-3 col-form-label">Dirección:</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" id="editDireccion" name="Direccion"
                                                    value="<?php echo $row['Direccion']; ?>" readonly>
                                            </div>
                                        </div>
                                  <!--  <div class="row mb-3">
                                            <div class="col-md-12">
                                                <button type="button" class="btn btn-primary float-end"
                                                    id="toggleEditButton" data-bs-toggle="modal"
                                                    data-bs-target="#editProfileModal">Editar</button>
                                            </div>
                                        </div>   -->
                                    </form>
                                <?php } else { ?>
                                    <div class="alert alert-danger" role="alert">
                                        No se encontraron datos del usuario.
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para editar -->
    <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProfileModalLabel">Editar Perfil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editProfileForm">
                        <!-- Aquí se deben poner los campos editables -->

                        <div class="mb-3">
                            <label for="editNombreUsuarioModal" class="col-form-label">Nombre Usuario:</label>
                            <input type="text" class="form-control" id="editNombreUsuarioModal"
                                name="NombreUsuarioModal" value="<?php echo $row['NombreUsuario']; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="editCorreoElectronicoModal" class="col-form-label">Correo Electrónico:</label>
                            <input type="email" class="form-control" id="editCorreoElectronicoModal"
                                name="CorreoElectronicoModal" value="<?php echo $row['CorreoElectronico']; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="editContrasenaModal" class="col-form-label">Contraseña:</label>
                            <input type="password" class="form-control" id="editContrasenaModal" name="ContrasenaModal"
                                value="<?php echo $row['Contrasena']; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="editNombreModal" class="col-form-label">Nombre:</label>
                            <input type="text" class="form-control" id="editNombreModal" name="NombreModal"
                                value="<?php echo $row['Nombre']; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="editApellidoModal" class="col-form-label">Apellido:</label>
                            <input type="text" class="form-control" id="editApellidoModal" name="ApellidoModal"
                                value="<?php echo $row['Apellido']; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="editSexoModal" class="col-form-label">Sexo:</label>
                            <input type="text" class="form-control" id="editSexoModal" name="SexoModal"
                                value="<?php echo $row['Sexo']; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="editFechaNacimientoModal" class="col-form-label">Fecha de
                                Nacimiento:</label>
                            <input type="text" class="form-control" id="editFechaNacimientoModal"
                                name="FechaNacimientoModal" value="<?php echo $row['FechaNacimiento']; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="editTelefonoModal" class="col-form-label">Teléfono:</label>
                            <input type="text" class="form-control" id="editTelefonoModal" name="TelefonoModal"
                                value="<?php echo $row['Telefono']; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="editDniModal" class="col-form-label">DNI:</label>
                            <input type="text" class="form-control" id="editDniModal" name="DniModal"
                                value="<?php echo $row['Dni']; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="editIdDireccionModal" class="col-form-label">ID Dirección:</label>
                            <input type="text" class="form-control" id="editIdDireccionModal" name="IdDireccionModal"
                                value="<?php echo $row['IdDireccion']; ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="editDepartamentoModal" class="col-form-label">Departamento:</label>
                            <input type="text" class="form-control" id="editDepartamentoModal" name="DepartamentoModal"
                                value="<?php echo $row['Departamento']; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="editProvinciaModal" class="col-form-label">Provincia:</label>
                            <input type="text" class="form-control" id="editProvinciaModal" name="ProvinciaModal"
                                value="<?php echo $row['Provincia']; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="editDistritoModal" class="col-form-label">Distrito:</label>
                            <input type="text" class="form-control" id="editDistritoModal" name="DistritoModal"
                                value="<?php echo $row['Distrito']; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="editDireccionModal" class="col-form-label">Dirección:</label>
                            <input type="text" class="form-control" id="editDireccionModal" name="DireccionModal"
                                value="<?php echo $row['Direccion']; ?>">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary" id="saveChangesButton">Guardar
                                Cambios</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Inicio del pie de página -->
    <footer class="bg-dark p-4 text-center text-white mt-auto">
        <p class="mb-0">Hecho por Team flech</p>
        <div class="social-media mt-2">
            <a href="#"><i class="bi bi-twitter px-2"></i></a>
            <a href="#"><i class="bi bi-facebook px-2"></i></a>
            <a href="#"><i class="bi bi-github px-2"></i></a>
            <a href="#"><i class="bi bi-whatsapp px-2"></i></a>
        </div>
    </footer>
    <!-- Fin del pie de página -->

    <!-- Script de Bootstrap y otros -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/js/bootstrap.min.js"></script>

    <!-- Script para manejar la edición del perfil -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Acceder al formulario de edición
            const editProfileForm = document.getElementById('editProfileForm');

            // Escuchar el evento de envío del formulario
            editProfileForm.addEventListener('submit', function(event) {
                event.preventDefault();

                // Recolectar los datos del formulario
                const formData = new FormData(document.getElementById('editProfileForm'));

                // Realizar la petición AJAX
                fetch('../../Admin/Menus/EditarPerfil.php', {

                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'success') {
                            alert('Perfil actualizado exitosamente.');
                            window.location.reload(); // Recargar la página para ver los cambios
                        } else {
                            alert('Error al actualizar el perfil: ' + data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error al actualizar el perfil:', error);
                        alert('Error de red. Por favor, inténtalo de nuevo más tarde.');
                    });
                document.getElementById('toggleEditButton').addEventListener('click', function() {
                    let inputs = document.querySelectorAll('#profileForm input');
                    inputs.forEach(input => {
                        input.readOnly = !input.readOnly;
                    });
                    // Cambiar el texto del botón
                    this.textContent = this.textContent === 'Editar' ? 'Cancelar' : 'Editar';
                    // Mostrar u ocultar el botón de guardar cambios
                    document.getElementById('saveChangesButton').classList.toggle('d-none');
                });

            });
        });
    </script>
</body>

</html>