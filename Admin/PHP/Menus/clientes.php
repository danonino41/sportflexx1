<?php
require_once(__DIR__ . "/../coneccion/conector.php");
$obj = new Conectar();
$conexion = $obj->getConexion();

if (!$conexion) {
    die("Error en la conexión: " . mysqli_connect_error());
}
$sqlClientes = "SELECT cliente.*, usuario.IdUsuario, usuario.NombreUsuario, usuario.CorreoElectronico, usuario.Contrasena, usuario.IdRol, direccion.IdDireccion, direccion.Departamento, direccion.Provincia, direccion.Distrito, direccion.Direccion 
                FROM cliente 
                JOIN usuario ON cliente.IdUsuario = usuario.IdUsuario 
                LEFT JOIN direccion ON cliente.IdCliente = direccion.IdCliente";
$rsClientes = mysqli_query($conexion, $sqlClientes);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Gestión de Clientes - SPORTFLEXX</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="../estilos/stylesAdmin.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        body {
            padding-top: 56px;
            background-color: white;
            color: black;
        }

        .card {
            width: 100%;
            background-color: white;
        }

        .btn {
            margin-bottom: 10px;
        }

        .table-responsive {
            overflow-x: auto;
            min-width: 100%;
        }

        .modal-content {
            background-color: #2c2c2c;
            color: white;
        }

        .modal-header {
            border-bottom: 1px solid #444;
        }

        .modal-footer {
            border-top: 1px solid #444;
        }

        .form-control {
            background-color: #333;
            color: white;
            border: 1px solid #444;
        }

        .form-select {
            background-color: #333;
            color: white;
            border: 1px solid #444;
        }

        footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            background-color: #1f1f1f;
            padding: 10px 0;
            text-align: center;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }

        .is-invalid {
            border-color: #dc3545;
        }

        .text-danger {
            color: #dc3545 !important;
        }
    </style>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand ps-3" href="../../../Cliente/HTML/MenuPrincipalCliente.php">SPORTFLEXX</a>
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!">
            <i class="fas fa-bars"></i>
        </button>
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <i class="fas fa-search"></i>
            </div>
        </form>
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#!">Settings</a></li>
                    <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="../../../Cliente/HTML/Logout.php">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Interface</div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                            data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon">
                                <i class="fas fa-columns"></i>
                            </div>
                            Layouts
                            <div class="sb-sidenav-collapse-arrow">
                                <i class="fas fa-angle-down"></i>
                            </div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="MenuAdmin.php">Inicio</a>
                                <a class="nav-link" href="../../../Cliente/HTML/MenuPrincipalCliente.php">SPORTFLEXX</a>
                            </nav>
                        </div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages"
                            aria-expanded="false" aria-controls="collapsePages">
                            <div class="sb-nav-link-icon">
                                <i class="fas fa-book-open"></i>
                            </div>
                            Pages
                            <div class="sb-sidenav-collapse-arrow">
                                <i class="fas fa-angle-down"></i>
                            </div>
                        </a>
                        <div class="collapse" id="collapsePages" aria-labelledby="headingTwo"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="clientes.php">
                                        <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                        Clientes
                                    </a>
                                    <a class="nav-link" href="Productos.php">
                                        <div class="sb-nav-link-icon"><i class="fas fa-boxes"></i></div>
                                        Productos
                                    </a>
                                    <a class="nav-link" href="Categoria.php">
                                        <div class="sb-nav-link-icon"><i class="fas fa-tags"></i></div>
                                        Categorías
                                    </a>
                                    <a class="nav-link" href="Direccion.php">
                                        <div class="sb-nav-link-icon"><i class="fas fa-map-marked-alt"></i></div>
                                        Direcciones
                                    </a>
                                    <a class="nav-link" href="Pedido.php">
                                        <div class="sb-nav-link-icon"><i class="fas fa-shopping-cart"></i></div>
                                        Pedidos
                                    </a>
                                    <a class="nav-link" href="Ventas.php">
                                        <div class="sb-nav-link-icon"><i class="fas fa-dollar-sign"></i></div>
                                        Ventas
                                    </a>
                                </nav>
                            </nav>
                        </div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseReports"
                            aria-expanded="false" aria-controls="collapseReports">
                            <div class="sb-nav-link-icon">
                                <i class="fas fa-chart-line"></i>
                            </div>
                            Reportes
                            <div class="sb-sidenav-collapse-arrow">
                                <i class="fas fa-angle-down"></i>
                            </div>
                        </a>
                        <div class="collapse" id="collapseReports" aria-labelledby="headingThree"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="ventasPorFecha.php">Ventas por Fecha</a>
                                <a class="nav-link" href="ventasPorCategoria.php">Ventas por Categoría</a>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    Start Bootstrap
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Clientes</h1>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Lista de Clientes
                        </div>
                        <div class="card-body">
                            <button class="btn btn-success mb-3" id="addClientBtn" data-bs-toggle="modal" data-bs-target="#modalCliente" onclick="clearForm()">Agregar Cliente</button>
                            <div class="table-responsive">
                                <table id="datatablesSimple" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID Usuario</th>
                                            <th>Nombre Usuario</th>
                                            <th>Correo Electrónico</th>
                                            <th>Contraseña</th>
                                            <th>ID Rol</th>
                                            <th>ID Cliente</th>
                                            <th>Nombre</th>
                                            <th>Apellido</th>
                                            <th>Sexo</th>
                                            <th>Fecha de Nacimiento</th>
                                            <th>Teléfono</th>
                                            <th>DNI</th>
                                            <th>ID Dirección</th>
                                            <th>Departamento</th>
                                            <th>Provincia</th>
                                            <th>Distrito</th>
                                            <th>Dirección</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($cliente = mysqli_fetch_assoc($rsClientes)) : ?>
                                            <tr>
                                                <td><?php echo $cliente['IdUsuario']; ?></td>
                                                <td><?php echo $cliente['NombreUsuario']; ?></td>
                                                <td><?php echo $cliente['CorreoElectronico']; ?></td>
                                                <td><?php echo $cliente['Contrasena']; ?></td>
                                                <td><?php echo $cliente['IdRol']; ?></td>
                                                <td><?php echo $cliente['IdCliente']; ?></td>
                                                <td><?php echo $cliente['Nombre']; ?></td>
                                                <td><?php echo $cliente['Apellido']; ?></td>
                                                <td><?php echo $cliente['Sexo']; ?></td>
                                                <td><?php echo $cliente['FechaNacimiento']; ?></td>
                                                <td><?php echo $cliente['Telefono']; ?></td>
                                                <td><?php echo $cliente['Dni']; ?></td>
                                                <td><?php echo $cliente['IdDireccion']; ?></td>
                                                <td><?php echo $cliente['Departamento']; ?></td>
                                                <td><?php echo $cliente['Provincia']; ?></td>
                                                <td><?php echo $cliente['Distrito']; ?></td>
                                                <td><?php echo $cliente['Direccion']; ?></td>
                                                <td>
                                                    <button class="btn btn-warning edit-btn" data-bs-toggle="modal" data-bs-target="#modalCliente" data-cliente='<?php echo json_encode($cliente); ?>'>Editar</button>
                                                    <button class="btn btn-danger delete-btn" data-id="<?php echo $cliente['IdCliente']; ?>">Eliminar</button>
                                                </td>
                                            </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; SPORTFLEXX 2024</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Modal for Add/Edit Form -->
    <div class="modal fade" id="modalCliente" tabindex="-1" aria-labelledby="modalClienteLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalClienteLabel">Cliente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="cliente-form" method="post" action="RegistrarCliente.php">
                        <input type="hidden" id="IdCliente" name="IdCliente" value="0">
                        <div class="mb-3">
                            <label for="cliente-IdUsuario">ID Usuario:</label>
                            <input type="number" id="cliente-IdUsuario" name="IdUsuario" class="form-control" required>
                            <span id="errorcliente-IdUsuario" class="text-danger"></span>
                        </div>
                        <div class="mb-3">
                            <label for="cliente-NombreUsuario">Nombre Usuario:</label>
                            <input type="text" id="cliente-NombreUsuario" name="NombreUsuario" class="form-control" required>
                            <span id="errorcliente-NombreUsuario" class="text-danger"></span>
                        </div>
                        <div class="mb-3">
                            <label for="cliente-CorreoElectronico">Correo Electrónico:</label>
                            <input type="email" id="cliente-CorreoElectronico" name="CorreoElectronico" class="form-control" required>
                            <span id="errorcliente-CorreoElectronico" class="text-danger"></span>
                        </div>
                        <div class="mb-3">
                            <label for="cliente-Contrasena">Contraseña:</label>
                            <input type="text" id="cliente-Contrasena" name="Contrasena" class="form-control" required>
                            <span id="errorcliente-Contrasena" class="text-danger"></span>
                        </div>
                        <div class="mb-3">
                            <label for="cliente-IdRol">ID Rol:</label>
                            <input type="number" id="cliente-IdRol" name="IdRol" class="form-control" required>
                            <span id="errorcliente-IdRol" class="text-danger"></span>
                        </div>
                        <div class="mb-3">
                            <label for="cliente-Nombre">Nombre:</label>
                            <input type="text" id="cliente-Nombre" name="Nombre" class="form-control" required>
                            <span id="errorcliente-Nombre" class="text-danger"></span>
                        </div>
                        <div class="mb-3">
                            <label for="cliente-Apellido">Apellido:</label>
                            <input type="text" id="cliente-Apellido" name="Apellido" class="form-control" required>
                            <span id="errorcliente-Apellido" class="text-danger"></span>
                        </div>
                        <div class="mb-3">
                            <label for="cliente-Sexo">Sexo:</label>
                            <select id="cliente-Sexo" name="Sexo" class="form-control" required>
                                <option value="" disabled selected>Seleccione</option>
                                <option value="male">Masculino</option>
                                <option value="female">Femenino</option>
                            </select>
                            <span id="errorcliente-Sexo" class="text-danger"></span>
                        </div>
                        <div class="mb-3">
                            <label for="cliente-FechaNacimiento">Fecha de Nacimiento:</label>
                            <input type="date" id="cliente-FechaNacimiento" name="FechaNacimiento" class="form-control" required>
                            <span id="errorcliente-FechaNacimiento" class="text-danger"></span>
                        </div>
                        <div class="mb-3">
                            <label for="cliente-Telefono">Teléfono:</label>
                            <input type="text" id="cliente-Telefono" name="Telefono" class="form-control" required>
                            <span id="errorcliente-Telefono" class="text-danger"></span>
                        </div>
                        <div class="mb-3">
                            <label for="cliente-Dni">DNI:</label>
                            <input type="text" id="cliente-Dni" name="Dni" class="form-control" required>
                            <span id="errorcliente-Dni" class="text-danger"></span>
                        </div>
                        <div class="mb-3">
                            <label for="cliente-Departamento">Departamento:</label>
                            <input type="text" id="cliente-Departamento" name="Departamento" class="form-control" required>
                            <span id="errorcliente-Departamento" class="text-danger"></span>
                        </div>
                        <div class="mb-3">
                            <label for="cliente-Provincia">Provincia:</label>
                            <input type="text" id="cliente-Provincia" name="Provincia" class="form-control" required>
                            <span id="errorcliente-Provincia" class="text-danger"></span>
                        </div>
                        <div class="mb-3">
                            <label for="cliente-Distrito">Distrito:</label>
                            <input type="text" id="cliente-Distrito" name="Distrito" class="form-control" required>
                            <span id="errorcliente-Distrito" class="text-danger"></span>
                        </div>
                        <div class="mb-3">
                            <label for="cliente-Direccion">Dirección:</label>
                            <input type="text" id="cliente-Direccion" name="Direccion" class="form-control" required>
                            <span id="errorcliente-Direccion" class="text-danger"></span>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Guardar Cliente</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="../js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="../assets/demo/chart-area-demo.js"></script>
    <script src="../assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="../js/datatables-simple-demo.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Mostrar datos en el formulario al hacer clic en Editar
            const editButtons = document.querySelectorAll(".edit-btn");
            editButtons.forEach(button => {
                button.addEventListener("click", function() {
                    const cliente = JSON.parse(this.getAttribute("data-cliente"));
                    document.getElementById("IdCliente").value = cliente.IdCliente;
                    document.getElementById("cliente-IdUsuario").value = cliente.IdUsuario;
                    document.getElementById("cliente-NombreUsuario").value = cliente.NombreUsuario;
                    document.getElementById("cliente-CorreoElectronico").value = cliente.CorreoElectronico;
                    document.getElementById("cliente-Contrasena").value = cliente.Contrasena;
                    document.getElementById("cliente-IdRol").value = cliente.IdRol;
                    document.getElementById("cliente-Nombre").value = cliente.Nombre;
                    document.getElementById("cliente-Apellido").value = cliente.Apellido;
                    document.getElementById("cliente-Sexo").value = cliente.Sexo;
                    document.getElementById("cliente-FechaNacimiento").value = cliente.FechaNacimiento;
                    document.getElementById("cliente-Telefono").value = cliente.Telefono;
                    document.getElementById("cliente-Dni").value = cliente.Dni;
                    document.getElementById("cliente-Departamento").value = cliente.Departamento;
                    document.getElementById("cliente-Provincia").value = cliente.Provincia;
                    document.getElementById("cliente-Distrito").value = cliente.Distrito;
                    document.getElementById("cliente-Direccion").value = cliente.Direccion;
                    document.getElementById("cliente-form").action = "EditarCliente.php";
                });
            });

            // Confirmar eliminación de cliente
            const deleteButtons = document.querySelectorAll(".delete-btn");
            deleteButtons.forEach(button => {
                button.addEventListener("click", function() {
                    const idCliente = this.getAttribute("data-id");
                    if (confirm("¿Estás seguro de que deseas eliminar este cliente?")) {
                        window.location.href = "EliminarCliente.php?id=" + idCliente;
                    }
                });
            });

            // Limpiar formulario al agregar nuevo cliente
            document.getElementById("addClientBtn").addEventListener("click", function() {
                clearForm();
                document.getElementById("cliente-form").action = "RegistrarCliente.php";
            });

            function clearForm() {
                document.getElementById("IdCliente").value = "0";
                document.getElementById("cliente-IdUsuario").value = "";
                document.getElementById("cliente-NombreUsuario").value = "";
                document.getElementById("cliente-CorreoElectronico").value = "";
                document.getElementById("cliente-Contrasena").value = "";
                document.getElementById("cliente-IdRol").value = "";
                document.getElementById("cliente-Nombre").value = "";
                document.getElementById("cliente-Apellido").value = "";
                document.getElementById("cliente-Sexo").value = "";
                document.getElementById("cliente-FechaNacimiento").value = "";
                document.getElementById("cliente-Telefono").value = "";
                document.getElementById("cliente-Dni").value = "";
                document.getElementById("cliente-Departamento").value = "";
                document.getElementById("cliente-Provincia").value = "";
                document.getElementById("cliente-Distrito").value = "";
                document.getElementById("cliente-Direccion").value = "";
            }

            // Validación en tiempo real
            function validateInput(input, regex, errorMsg) {
                const value = input.value;
                const errorSpan = document.getElementById(`error${input.id}`);
                if (!regex.test(value)) {
                    errorSpan.textContent = errorMsg;
                    input.classList.add('is-invalid');
                } else {
                    errorSpan.textContent = '';
                    input.classList.remove('is-invalid');
                }
            }

            const validations = [{
                    id: "cliente-IdUsuario",
                    regex: /^\d+$/,
                    errorMsg: "ID Usuario inválido (solo números)"
                },
                {
                    id: "cliente-NombreUsuario",
                    regex: /^[a-zA-Z0-9]+$/,
                    errorMsg: "Nombre de usuario inválido"
                },
                {
                    id: "cliente-CorreoElectronico",
                    regex: /^[^\s@]+@[^\s@]+\.[^\s@]+$/,
                    errorMsg: "Correo electrónico inválido"
                },
                {
                    id: "cliente-Contrasena",
                    regex: /^.{6,}$/,
                    errorMsg: "Contraseña inválida (mínimo 6 caracteres)"
                },
                {
                    id: "cliente-IdRol",
                    regex: /^\d+$/,
                    errorMsg: "ID Rol inválido (solo números)"
                },
                {
                    id: "cliente-Nombre",
                    regex: /^[a-zA-Z\s]+$/,
                    errorMsg: "Nombre inválido (solo letras y espacios)"
                },
                {
                    id: "cliente-Apellido",
                    regex: /^[a-zA-Z\s]+$/,
                    errorMsg: "Apellido inválido (solo letras y espacios)"
                },
                {
                    id: "cliente-Sexo",
                    regex: /^(male|female)$/,
                    errorMsg: "Sexo inválido (solo 'male' o 'female')"
                },
                {
                    id: "cliente-Telefono",
                    regex: /^\d+$/,
                    errorMsg: "Teléfono inválido (solo números)"
                },
                {
                    id: "cliente-Dni",
                    regex: /^\d+$/,
                    errorMsg: "DNI inválido (solo números)"
                },
                {
                    id: "cliente-Departamento",
                    regex: /^[a-zA-Z\s]+$/,
                    errorMsg: "Departamento inválido (solo letras y espacios)"
                },
                {
                    id: "cliente-Provincia",
                    regex: /^[a-zA-Z\s]+$/,
                    errorMsg: "Provincia inválida (solo letras y espacios)"
                },
                {
                    id: "cliente-Distrito",
                    regex: /^[a-zA-Z\s]+$/,
                    errorMsg: "Distrito inválido (solo letras y espacios)"
                },
                {
                    id: "cliente-Direccion",
                    regex: /^[a-zA-Z0-9\s]+$/,
                    errorMsg: "Dirección inválida (letras, números y espacios)"
                }
            ];

            validations.forEach(validation => {
                const inputElement = document.getElementById(validation.id);
                if (inputElement) {
                    inputElement.addEventListener("input", function() {
                        validateInput(this, validation.regex, validation.errorMsg);
                    });
                }
            });
        });
    </script>
</body>

</html>