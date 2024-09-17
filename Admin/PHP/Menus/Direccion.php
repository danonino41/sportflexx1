<?php
require_once(__DIR__ . "/../coneccion/conector.php");

// Crear objeto de la clase Conectar
$obj = new Conectar();
// Sentencia select con JOIN para obtener los detalles de la dirección
$sql = "
    SELECT d.IdDireccion, d.IdCliente, d.Departamento, d.Provincia, d.Distrito, d.Direccion,
           c.Nombre AS NombreCliente, c.Apellido AS ApellidoCliente
    FROM direccion d
    LEFT JOIN cliente c ON d.IdCliente = c.IdCliente
";
// Obtener los registros de la tabla dirección y sus detalles
$rsDirecciones = mysqli_query($obj->getConexion(), $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Gestión de Direcciones - SPORTFLEXX</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="../estilos/stylesAdmin.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
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
                <h1 class="mt-4">Direcciones</h1>
                <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalDireccion" onclick="clearForm()">Nueva Dirección</button>
                <div class="modal fade" id="modalDireccion" tabindex="-1" aria-labelledby="modalDireccionLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalDireccionLabel">Dirección</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!-- Formulario de Dirección -->
                                <form id="Direccion-form" method="post" action="RegistrarDireccion.php">
                                    <input type="hidden" id="IdDireccion" name="IdDireccion" value="0">
                                    <div class="mb-3">
                                        <label for="direccion-IdCliente">ID Cliente</label>
                                        <select id="direccion-IdCliente" name="IdCliente" class="form-control" required>
                                            <option value="" disabled selected>Selecciona un cliente</option>
                                            <?php
                                            $sqlClientes = "SELECT IdCliente, Nombre, Apellido FROM cliente";
                                            $rsClientes = mysqli_query($obj->getConexion(), $sqlClientes);
                                            while ($cliente = mysqli_fetch_array($rsClientes)) {
                                                echo "<option value='" . $cliente['IdCliente'] . "'>" . $cliente['Nombre'] . " " . $cliente['Apellido'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                        <div class="invalid-feedback" id="cliente-error"></div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="direccion-Departamento">Departamento</label>
                                        <input type="text" id="direccion-Departamento" name="Departamento" class="form-control" required>
                                        <div class="invalid-feedback" id="departamento-error"></div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="direccion-Provincia">Provincia</label>
                                        <input type="text" id="direccion-Provincia" name="Provincia" class="form-control" required>
                                        <div class="invalid-feedback" id="provincia-error"></div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="direccion-Distrito">Distrito</label>
                                        <input type="text" id="direccion-Distrito" name="Distrito" class="form-control" required>
                                        <div class="invalid-feedback" id="distrito-error"></div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="direccion-Direccion">Dirección</label>
                                        <input type="text" id="direccion-Direccion" name="Direccion" class="form-control" required>
                                        <div class="invalid-feedback" id="direccion-error"></div>
                                    </div>
                                    <button type="submit" class="btn btn-primary mt-3">Guardar Dirección</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Direcciones
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>IdDireccion</th>
                                    <th>IdCliente</th>
                                    <th>Nombre Cliente</th>
                                    <th>Apellido Cliente</th>
                                    <th>Departamento</th>
                                    <th>Provincia</th>
                                    <th>Distrito</th>
                                    <th>Dirección</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($registro = mysqli_fetch_array($rsDirecciones)) {
                                    echo "<tr>";
                                    echo "<td>" . $registro['IdDireccion'] . "</td>";
                                    echo "<td>" . $registro['IdCliente'] . "</td>";
                                    echo "<td>" . $registro['NombreCliente'] . "</td>";
                                    echo "<td>" . $registro['ApellidoCliente'] . "</td>";
                                    echo "<td>" . $registro['Departamento'] . "</td>";
                                    echo "<td>" . $registro['Provincia'] . "</td>";
                                    echo "<td>" . $registro['Distrito'] . "</td>";
                                    echo "<td>" . $registro['Direccion'] . "</td>";
                                    echo "<td>
                                            <button class='btn btn-primary btn-sm edit-btn' data-bs-toggle='modal' data-bs-target='#modalDireccion' data-direccion='" . json_encode($registro) . "'>Editar</button>
                                            <form method='post' action='EliminarDireccion.php' class='d-inline delete-form'>
                                                <input type='hidden' name='Direccion-Id' value='" . $registro['IdDireccion'] . "'>
                                                <button type='submit' class='btn btn-danger btn-sm'>Eliminar</button>
                                            </form>
                                        </td>";
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
<script src="../js/scripts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"
        crossorigin="anonymous"></script>
<script src="../assets/demo/chart-area-demo.js"></script>
<script src="../assets/demo/chart-bar-demo.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
<script src="../js/datatables-simple-demo.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const editButtons = document.querySelectorAll(".edit-btn");
        editButtons.forEach(button => {
            button.addEventListener("click", (event) => {
                const direccion = JSON.parse(event.currentTarget.getAttribute("data-direccion"));
                loadDireccionData(direccion);
            });
        });

        const deleteForms = document.querySelectorAll(".delete-form");
        deleteForms.forEach(form => {
            form.addEventListener("submit", (event) => {
                event.preventDefault();
                const confirmation = confirm("¿Está seguro de que desea eliminar esta Dirección?");
                if (confirmation) {
                    form.submit();
                }
            });
        });

        // Validaciones en tiempo real
        document.getElementById("direccion-Departamento").addEventListener("input", function () {
            const departamento = this.value.trim();
            if (/[^a-zA-Z\s]/.test(departamento)) {
                document.getElementById("departamento-error").textContent = "Solo se permiten letras.";
                this.classList.add("is-invalid");
            } else {
                document.getElementById("departamento-error").textContent = "";
                this.classList.remove("is-invalid");
            }
        });

        document.getElementById("direccion-Provincia").addEventListener("input", function () {
            const provincia = this.value.trim();
            if (/[^a-zA-Z\s]/.test(provincia)) {
                document.getElementById("provincia-error").textContent = "Solo se permiten letras.";
                this.classList.add("is-invalid");
            } else {
                document.getElementById("provincia-error").textContent = "";
                this.classList.remove("is-invalid");
            }
        });

        document.getElementById("direccion-Distrito").addEventListener("input", function () {
            const distrito = this.value.trim();
            if (/[^a-zA-Z\s]/.test(distrito)) {
                document.getElementById("distrito-error").textContent = "Solo se permiten letras.";
                this.classList.add("is-invalid");
            } else {
                document.getElementById("distrito-error").textContent = "";
                this.classList.remove("is-invalid");
            }
        });

        document.getElementById("direccion-Direccion").addEventListener("input", function () {
            const direccion = this.value.trim();
            if (direccion === "") {
                document.getElementById("direccion-error").textContent = "La dirección es obligatoria.";
                this.classList.add("is-invalid");
            } else {
                document.getElementById("direccion-error").textContent = "";
                this.classList.remove("is-invalid");
            }
        });

        document.getElementById("direccion-IdCliente").addEventListener("change", function () {
            if (this.value === "") {
                document.getElementById("cliente-error").textContent = "Debe seleccionar un cliente.";
                this.classList.add("is-invalid");
            } else {
                document.getElementById("cliente-error").textContent = "";
                this.classList.remove("is-invalid");
            }
        });

        document.getElementById("Direccion-form").addEventListener("submit", function (event) {
            if (document.querySelectorAll(".is-invalid").length > 0) {
                event.preventDefault();
                alert("Por favor, corrija los errores en el formulario.");
            }
        });
    });

    function loadDireccionData(direccion) {
        document.getElementById("IdDireccion").value = direccion.IdDireccion;
        document.getElementById("direccion-IdCliente").value = direccion.IdCliente;
        document.getElementById("direccion-Departamento").value = direccion.Departamento;
        document.getElementById("direccion-Provincia").value = direccion.Provincia;
        document.getElementById("direccion-Distrito").value = direccion.Distrito;
        document.getElementById("direccion-Direccion").value = direccion.Direccion;
    }

    function clearForm() {
        document.getElementById("IdDireccion").value = 0;
        document.getElementById("direccion-IdCliente").value = '';
        document.getElementById("direccion-Departamento").value = '';
        document.getElementById("direccion-Provincia").value = '';
        document.getElementById("direccion-Distrito").value = '';
        document.getElementById("direccion-Direccion").value = '';

        document.querySelectorAll(".is-invalid").forEach(element => {
            element.classList.remove("is-invalid");
        });
        document.querySelectorAll(".invalid-feedback").forEach(element => {
            element.textContent = "";
        });
    }
</script>
</body>
</html>
