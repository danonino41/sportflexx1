<?php
require_once(__DIR__ . "/../coneccion/conector.php");

// Crear objeto de la clase Conectar
$obj = new Conectar();
// Sentencia select con JOIN para obtener los detalles de la venta
$sql = "
    SELECT v.IdVenta, v.IdPedido, v.FechaVenta, v.IGV, v.Total, v.Descuento, tp.Tipo
    FROM venta v
    LEFT JOIN tipopago tp ON v.IdTipoPago = tp.IdTipoPago
";
// Obtener los registros de la tabla venta y sus detalles
$rsVentas = mysqli_query($obj->getConexion(), $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Gestión de Ventas - SPORTFLEXX</title>
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
                    <h1 class="mt-4">Ventas</h1>
                    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalVenta" onclick="clearForm()">Nueva Venta</button>

                    <div class="modal fade" id="modalVenta" tabindex="-1" aria-labelledby="modalVentaLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalVentaLabel">Venta</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- Formulario de Venta -->
                                    <form id="Venta-form" method="post" action="RegistrarVenta.php">
                                        <input type="hidden" id="IdVenta" name="IdVenta" value="0">
                                        <div class="mb-3">
                                            <label for="venta-IdPedido">ID Pedido</label>
                                            <select id="venta-IdPedido" name="IdPedido" class="form-control" required onchange="fetchPedidoDetails(this.value)">
                                                <option value="" disabled selected>Selecciona un pedido</option>
                                                <?php
                                                $sqlPedidos = "SELECT IdPedido, NumeroPedido FROM pedido";
                                                $rsPedidos = mysqli_query($obj->getConexion(), $sqlPedidos);
                                                while ($pedido = mysqli_fetch_array($rsPedidos)) {
                                                    echo "<option value='" . $pedido['IdPedido'] . "'>" . $pedido['NumeroPedido'] . "</option>";
                                                }
                                                ?>
                                            </select>
                                            <div class="invalid-feedback" id="pedido-error"></div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="venta-FechaVenta">Fecha de Venta</label>
                                            <input type="date" id="venta-FechaVenta" name="FechaVenta" class="form-control" required>
                                            <div class="invalid-feedback" id="fecha-error"></div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="venta-IGV">IGV (%)</label>
                                            <input type="number" id="venta-IGV" name="IGV" class="form-control" required value="18">
                                            <div class="invalid-feedback" id="igv-error"></div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="venta-Descuento">Descuento (S/)</label>
                                            <input type="number" id="venta-Descuento" name="Descuento" class="form-control" readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label for="venta-Total">Total (S/)</label>
                                            <input type="number" id="venta-Total" name="Total" class="form-control" readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label for="venta-IdTipoPago">Tipo de Pago</label>
                                            <select id="venta-IdTipoPago" name="IdTipoPago" class="form-control" required>
                                                <option value="" disabled selected>Selecciona un tipo de pago</option>
                                                <?php
                                                $sqlTiposPago = "SELECT IdTipoPago, Tipo FROM tipopago";
                                                $rsTiposPago = mysqli_query($obj->getConexion(), $sqlTiposPago);
                                                while ($tipoPago = mysqli_fetch_array($rsTiposPago)) {
                                                    echo "<option value='" . $tipoPago['IdTipoPago'] . "'>" . $tipoPago['Tipo'] . "</option>";
                                                }
                                                ?>
                                            </select>
                                            <div class="invalid-feedback" id="tipoPago-error"></div>
                                        </div>
                                        <button type="submit" class="btn btn-primary mt-3">Guardar Venta</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Ventas
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>IdVenta</th>
                                        <th>IdPedido</th>
                                        <th>Fecha de Venta</th>
                                        <th>IGV</th>
                                        <th>Descuento</th>
                                        <th>Total</th>
                                        <th>Tipo de Pago</th>
                                        <th>Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while ($registro = mysqli_fetch_array($rsVentas)) {
                                        echo "<tr>";
                                        echo "<td>" . $registro['IdVenta'] . "</td>";
                                        echo "<td>" . $registro['IdPedido'] . "</td>";
                                        echo "<td>" . $registro['FechaVenta'] . "</td>";
                                        echo "<td>" . $registro['IGV'] . "</td>";
                                        echo "<td>" . $registro['Descuento'] . "</td>";
                                        echo "<td>" . $registro['Total'] . "</td>";
                                        echo "<td>" . $registro['Tipo'] . "</td>";
                                        echo "<td>
                                                <button class='btn btn-primary btn-sm edit-btn' data-bs-toggle='modal' data-bs-target='#modalVenta' onclick='loadVentaData(this)'>Editar</button>
                                                <form method='post' action='EliminarVenta.php' class='d-inline delete-form'>
                                                    <input type='hidden' name='Venta-Id' value='" . $registro['IdVenta'] . "'>
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
                    const venta = JSON.parse(event.currentTarget.getAttribute("data-venta"));
                    loadVentaData(venta);
                });
            });

            const deleteForms = document.querySelectorAll(".delete-form");
            deleteForms.forEach(form => {
                form.addEventListener("submit", (event) => {
                    event.preventDefault();
                    const confirmation = confirm("¿Está seguro de que desea eliminar esta Venta?");
                    if (confirmation) {
                        form.submit();
                    }
                });
            });

            document.getElementById("Venta-form").addEventListener("submit", function(event) {
                event.preventDefault();
                if (validateForm()) {
                    this.submit();
                }
            });

            function validateForm() {
                let valid = true;

                const idPedido = document.getElementById("venta-IdPedido");
                const fechaVenta = document.getElementById("venta-FechaVenta");
                const igv = document.getElementById("venta-IGV");
                const tipoPago = document.getElementById("venta-IdTipoPago");

                if (idPedido.value === "") {
                    idPedido.classList.add("is-invalid");
                    document.getElementById("pedido-error").textContent = "Selecciona un pedido.";
                    valid = false;
                } else {
                    idPedido.classList.remove("is-invalid");
                    document.getElementById("pedido-error").textContent = "";
                }

                if (fechaVenta.value === "") {
                    fechaVenta.classList.add("is-invalid");
                    document.getElementById("fecha-error").textContent = "Selecciona una fecha de venta.";
                    valid = false;
                } else {
                    fechaVenta.classList.remove("is-invalid");
                    document.getElementById("fecha-error").textContent = "";
                }

                if (igv.value === "") {
                    igv.classList.add("is-invalid");
                    document.getElementById("igv-error").textContent = "El IGV es obligatorio.";
                    valid = false;
                } else {
                    igv.classList.remove("is-invalid");
                    document.getElementById("igv-error").textContent = "";
                }

                if (tipoPago.value === "") {
                    tipoPago.classList.add("is-invalid");
                    document.getElementById("tipoPago-error").textContent = "Selecciona un tipo de pago.";
                    valid = false;
                } else {
                    tipoPago.classList.remove("is-invalid");
                    document.getElementById("tipoPago-error").textContent = "";
                }

                return valid;
            }
        });

        function loadVentaData(venta) {
            document.getElementById("IdVenta").value = venta.IdVenta;
            document.getElementById("venta-IdPedido").value = venta.IdPedido;
            document.getElementById("venta-FechaVenta").value = venta.FechaVenta;
            document.getElementById("venta-IGV").value = venta.IGV;
            document.getElementById("venta-Descuento").value = venta.Descuento;
            document.getElementById("venta-Total").value = venta.Total;
            document.getElementById("venta-IdTipoPago").value = venta.IdTipoPago;
        }

        function fetchPedidoDetails(idPedido) {
            fetch('ObtenerDetallesPedido.php?idPedido=' + idPedido)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById("venta-Descuento").value = data.descuento;
                        document.getElementById("venta-Total").value = data.total;
                    } else {
                        alert('ID de Pedido no encontrado.');
                    }
                });
        }

        function clearForm() {
            document.getElementById("IdVenta").value = 0;
            document.getElementById("venta-IdPedido").value = '';
            document.getElementById("venta-FechaVenta").value = '';
            document.getElementById("venta-IGV").value = '';
            document.getElementById("venta-Descuento").value = '';
            document.getElementById("venta-Total").value = '';
            document.getElementById("venta-IdTipoPago").value = '';

            // Limpiar mensajes de error
            document.getElementById("pedido-error").textContent = "";
            document.getElementById("fecha-error").textContent = "";
            document.getElementById("igv-error").textContent = "";
            document.getElementById("tipoPago-error").textContent = "";

            const formControls = document.querySelectorAll('.form-control');
            formControls.forEach(control => control.classList.remove('is-invalid'));
        }
    </script>
</body>
</html>
