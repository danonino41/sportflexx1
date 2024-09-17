<?php
require_once(__DIR__ . "/../coneccion/conector.php");

$obj = new Conectar();
$sql = "SELECT p.*, c.Nombre as CategoriaNombre FROM producto p JOIN categoria c ON p.IdCategoria = c.IdCategoria";
$rsMed = mysqli_query($obj->getConexion(), $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Gestión de Productos - SPORTFLEXX</title>
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
                    <h1 class="mt-4">Productos</h1>
                    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalProducto" onclick="clearForm()">Nuevo Producto</button>
                    <!-- Modal for Add/Edit Form -->
<div id="modalProducto" class="modal fade" tabindex="-1" aria-labelledby="modalProductoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalProductoLabel">Producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="product-form" method="post" action="RegistrarProducto.php" enctype="multipart/form-data">
                    <input type="hidden" id="IdProducto" name="IdProducto" value="0">
                    <div class="mb-3">
                        <label for="product-code">Codigo del producto:</label>
                        <input type="text" id="product-code" name="CodigoProducto" class="form-control" required>
                        <span id="errorproduct-code" class="text-danger"></span>
                    </div>
                    <div class="mb-3">
                        <label for="product-name">Nombre del Producto:</label>
                        <input type="text" id="product-name" name="Nombre" class="form-control" required>
                        <span id="errorproduct-name" class="text-danger"></span>
                    </div>
                    <div class="mb-3">
                        <label for="product-description">Descripción:</label>
                        <textarea id="product-description" name="Descripcion" class="form-control" required></textarea>
                        <span id="errorproduct-description" class="text-danger"></span>
                    </div>
                    <div class="mb-3">
                        <label for="product-stock">Stock:</label>
                        <input type="number" id="product-stock" name="Stock" class="form-control" required>
                        <span id="errorproduct-stock" class="text-danger"></span>
                    </div>
                    <div class="mb-3">
                        <label for="product-size" class="form-label">Talla</label>
                        <select class="form-select" id="product-size" name="Talla" required>
                            <option selected></option>
                            <option value="S">S</option>
                            <option value="M">M</option>
                            <option value="L">L</option>
                            <option value="XL">XL</option>
                        </select>
                        <span id="errorproduct-size" class="text-danger"></span>
                    </div>
                    <div class="mb-3">
                        <label for="product-color" class="form-label">Color</label>
                        <input type="text" id="product-color" name="Color" class="form-control" required>
                        <span id="errorproduct-color" class="text-danger"></span>
                    </div>
                    <div class="mb-3">
                        <label for="product-category">Categoría:</label>
                        <select id="product-category" name="IdCategoria" class="form-control" required>
                            <option value="">[Seleccione Categoria]</option>
                            <?php
                            $sql_categorias = "SELECT * FROM categoria";
                            $rs_categorias = mysqli_query($obj->getConexion(), $sql_categorias);
                            while ($row_categoria = mysqli_fetch_array($rs_categorias)) {
                                echo "<option value='" . $row_categoria['IdCategoria'] . "'>" . $row_categoria['Nombre'] . "</option>";
                            }
                            ?>
                        </select>
                        <span id="errorproduct-category" class="text-danger"></span>
                    </div>
                    <div class="mb-3">
                        <label for="product-price">Precio:</label>
                        <input type="number" id="product-price" name="PrecioUnitario" class="form-control" step="0.01" required>
                        <span id="errorproduct-price" class="text-danger"></span>
                    </div>
                    <div class="mb-3">
                        <label for="product-date" class="form-label">Fecha de Registro</label>
                        <input type="date" id="product-date" name="FechaRegistro" class="form-control" required>
                        <span id="errorproduct-date" class="text-danger"></span>
                    </div>
                    <div class="mb-3">
                        <label for="product-gender" class="form-label">Genero</label>
                        <select class="form-select" id="product-gender" name="Genero" required>
                            <option selected></option>
                            <option value="M">M</option>
                            <option value="F">F</option>
                        </select>
                        <span id="errorproduct-gender" class="text-danger"></span>
                    </div>
                    <div class="mb-3">
                        <label for="product-images">Imágenes:</label>
                        <input type="file" id="product-images" name="ImagenProducto" class="form-control" multiple>
                        <span id="errorproduct-images" class="text-danger"></span>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Guardar Producto</button>
                </form>
            </div>
        </div>
    </div>
</div>

                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Productos
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>IdProducto</th>
                                        <th>CodigoProducto</th>
                                        <th>Nombre</th>
                                        <th>Descripcion</th>
                                        <th>Stock</th>
                                        <th>Talla</th>
                                        <th>Color</th>
                                        <th>Categoria</th>
                                        <th>Precio</th>
                                        <th>FechaRegistro</th>
                                        <th>Genero</th>
                                        <th>Imagen</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($registro = mysqli_fetch_array($rsMed)) { ?>
                                        <tr>
                                            <td><?php echo $registro["IdProducto"]; ?></td>
                                            <td><?php echo $registro["CodigoProducto"]; ?></td>
                                            <td><?php echo $registro["Nombre"]; ?></td>
                                            <td><?php echo $registro["Descripcion"]; ?></td>
                                            <td><?php echo $registro["Stock"]; ?></td>
                                            <td><?php echo $registro["Talla"]; ?></td>
                                            <td><?php echo $registro["Color"]; ?></td>
                                            <td><?php echo $registro["CategoriaNombre"]; ?></td>
                                            <td><?php echo $registro["PrecioUnitario"]; ?></td>
                                            <td><?php echo $registro["FechaRegistro"]; ?></td>
                                            <td><?php echo $registro["Genero"]; ?></td>
                                            <td><?php echo $registro["ImagenProducto"]; ?></td>
                                            <td>
                                                <button class="btn btn-primary btn-sm edit-btn" data-id="<?php echo $registro['IdProducto']; ?>" data-bs-toggle="modal" data-bs-target="#modalProducto">Editar</button>
                                                <form method="POST" action="EliminarProducto.php" style="display:inline;" class="delete-form">
                                                    <input type="hidden" name="product-id" value="<?php echo $registro['IdProducto']; ?>">
                                                    <button type="submit" class="btn btn-danger btn-sm delete-btn">Eliminar</button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php } ?>
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
        button.addEventListener("click", () => {
            const row = button.closest("tr");
            document.getElementById("IdProducto").value = row.cells[0].innerText;
            document.getElementById("product-code").value = row.cells[1].innerText;
            document.getElementById("product-name").value = row.cells[2].innerText;
            document.getElementById("product-description").value = row.cells[3].innerText;
            document.getElementById("product-stock").value = row.cells[4].innerText;
            document.getElementById("product-size").value = row.cells[5].innerText;
            document.getElementById("product-color").value = row.cells[6].innerText;
            document.getElementById("product-category").value = row.cells[7].innerText;
            document.getElementById("product-price").value = row.cells[8].innerText;
            document.getElementById("product-date").value = row.cells[9].innerText;
            document.getElementById("product-gender").value = row.cells[10].innerText;
        });
    });

    const deleteForms = document.querySelectorAll(".delete-form");
    deleteForms.forEach(form => {
        form.addEventListener("submit", (event) => {
            event.preventDefault();
            const confirmation = confirm("¿Está seguro de que desea eliminar este producto?");
            if (confirmation) {
                form.submit();
            }
        });
    });

    function clearForm() {
        document.getElementById("IdProducto").value = "0";
        document.getElementById("product-code").value = "";
        document.getElementById("product-name").value = "";
        document.getElementById("product-description").value = "";
        document.getElementById("product-stock").value = "";
        document.getElementById("product-size").value = "";
        document.getElementById("product-color").value = "";
        document.getElementById("product-category").value = "";
        document.getElementById("product-price").value = "";
        document.getElementById("product-date").value = "";
        document.getElementById("product-gender").value = "";
        document.getElementById("product-images").value = "";
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

    const validations = [
        { id: "product-code", regex: /^[a-zA-Z0-9]+$/, errorMsg: "Código de producto inválido" },
        { id: "product-name", regex: /^[a-zA-Z0-9\s]+$/, errorMsg: "Nombre de producto inválido" },
        { id: "product-description", regex: /^[a-zA-Z0-9\s]+$/, errorMsg: "Descripción inválida" },
        { id: "product-stock", regex: /^\d+$/, errorMsg: "Stock inválido (solo números)" },
        { id: "product-color", regex: /^[a-zA-Z\s]+$/, errorMsg: "Color inválido (solo letras y espacios)" },
        { id: "product-category", regex: /^\d+$/, errorMsg: "Categoría inválida (seleccione una opción)" },
        { id: "product-price", regex: /^\d+(\.\d{1,2})?$/, errorMsg: "Precio inválido (número con hasta 2 decimales)" },
        { id: "product-date", regex: /^\d{4}-\d{2}-\d{2}$/, errorMsg: "Fecha de registro inválida" },
        { id: "product-gender", regex: /^(M|F)$/, errorMsg: "Género inválido (M o F)" }
    ];

    validations.forEach(validation => {
        const addElement = document.getElementById(validation.id);
        if (addElement) {
            addElement.addEventListener("input", function() {
                validateInput(this, validation.regex, validation.errorMsg);
            });
        }

        const editElement = document.getElementById(validation.id.replace('add', 'edit'));
        if (editElement) {
            editElement.addEventListener("input", function() {
                validateInput(this, validation.regex, validation.errorMsg);
            });
        }
    });
});

    </script>
</body>
</html>
