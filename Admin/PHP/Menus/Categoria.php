<?php
require_once(__DIR__ . "/../coneccion/conector.php");
$obj = new Conectar();
$sql = "SELECT * FROM categoria";
$rsMed = mysqli_query($obj->getConexion(), $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Gestión de Categoría - SPORTFLEXX</title>
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
                                <i class="fas fa-chart-line"></i></div>
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
                    <h1 class="mt-4">Categorías</h1>
                    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalCategoria" onclick="clearForm()">Nueva Categoría</button>
                    <div class="modal fade" id="modalCategoria" tabindex="-1" aria-labelledby="modalCategoriaLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalCategoriaLabel">Categoría</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="Categoria-form">
                                        <input type="hidden" id="IdCategoria" name="IdCategoria" value="0">
                                        <div class="mb-3">
                                            <label for="categoria-Nombre" class="form-label">Nombre</label>
                                            <input type="text" id="categoria-Nombre" name="Nombre" class="form-control" required>
                                            <div class="invalid-feedback" id="nombre-error"></div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="categoria-Descripcion" class="form-label">Descripción</label>
                                            <input type="text" id="categoria-Descripcion" name="Descripcion" class="form-control" required>
                                            <div class="invalid-feedback" id="descripcion-error"></div>
                                        </div>
                                        <button type="submit" class="btn btn-primary mt-3">Guardar Categoría</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Categorías
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>IdCategoría</th>
                                        <th>Nombre</th>
                                        <th>Descripción</th>
                                        <th>Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($registro = mysqli_fetch_array($rsMed)) { ?>
                                        <tr>
                                            <td><?php echo $registro["IdCategoria"]; ?></td>
                                            <td><?php echo $registro["Nombre"]; ?></td>
                                            <td><?php echo $registro["Descripcion"]; ?></td>
                                            <td>
                                                <button class="btn btn-primary btn-sm edit-btn" data-id="<?php echo $registro['IdCategoria']; ?>" data-bs-toggle="modal" data-bs-target="#modalCategoria">Editar</button>
                                                <form method="POST" action="EliminarCategoria.php" style="display:inline;" class="delete-form">
                                                    <input type="hidden" name="Categoria-Id" value="<?php echo $registro['IdCategoria']; ?>">
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
                            <a href="#">Terms & Conditions</a>
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
            document.getElementById("IdCategoria").value = row.cells[0].innerText.trim();
            document.getElementById("categoria-Nombre").value = row.cells[1].innerText.trim();
            document.getElementById("categoria-Descripcion").value = row.cells[2].innerText.trim();
        });
    });

    const deleteForms = document.querySelectorAll(".delete-form");
    deleteForms.forEach(form => {
        form.addEventListener("submit", (event) => {
            event.preventDefault();
            const confirmation = confirm("¿Está seguro de que desea eliminar esta Categoría?");
            if (confirmation) {
                const idCategoria = form.querySelector('input[name="Categoria-Id"]').value;

                fetch("EliminarCategoria.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({ 'Categoria-Id': idCategoria })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert("Error al eliminar la categoría.");
                    }
                })
                .catch(error => console.error("Error:", error));
            }
        });
    });

    document.getElementById("Categoria-form").addEventListener("submit", function(event) {
        event.preventDefault();

        const nombre = document.getElementById("categoria-Nombre").value.trim();
        const descripcion = document.getElementById("categoria-Descripcion").value.trim();
        const idCategoria = document.getElementById("IdCategoria").value.trim();

        let valid = true;

        if (nombre === "" || /[^a-zA-Z\s]/.test(nombre)) {
            valid = false;
            document.getElementById("nombre-error").textContent = "El nombre es obligatorio y solo debe contener letras.";
            document.getElementById("categoria-Nombre").classList.add("is-invalid");
        } else {
            document.getElementById("nombre-error").textContent = "";
            document.getElementById("categoria-Nombre").classList.remove("is-invalid");
        }

        if (descripcion === "") {
            valid = false;
            document.getElementById("descripcion-error").textContent = "La descripción es obligatoria.";
            document.getElementById("categoria-Descripcion").classList.add("is-invalid");
        } else {
            document.getElementById("descripcion-error").textContent = "";
            document.getElementById("categoria-Descripcion").classList.remove("is-invalid");
        }

        if (valid) {
            const data = {
                IdCategoria: idCategoria,
                Nombre: nombre,
                Descripcion: descripcion
            };

            fetch("RegistrarCategoria.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert("Error al guardar la categoría.");
                }
            })
            .catch(error => console.error("Error:", error));
        }
    });

    document.getElementById("categoria-Nombre").addEventListener("input", function() {
        const nombre = this.value.trim();
        if (nombre === "" || /[^a-zA-Z\s]/.test(nombre)) {
            document.getElementById("nombre-error").textContent = "El nombre es obligatorio y solo debe contener letras.";
            this.classList.add("is-invalid");
        } else {
            document.getElementById("nombre-error").textContent = "";
            this.classList.remove("is-invalid");
        }
    });

    document.getElementById("categoria-Descripcion").addEventListener("input", function() {
        const descripcion = this.value.trim();
        if (descripcion === "") {
            document.getElementById("descripcion-error").textContent = "La descripción es obligatoria.";
            this.classList.add("is-invalid");
        } else {
            document.getElementById("descripcion-error").textContent = "";
            this.classList.remove("is-invalid");
        }
    });
});

function clearForm() {
    document.getElementById("IdCategoria").value = "0";
    document.getElementById("categoria-Nombre").value = "";
    document.getElementById("categoria-Descripcion").value = "";
    document.getElementById("nombre-error").textContent = "";
    document.getElementById("descripcion-error").textContent = "";
    document.getElementById("categoria-Nombre").classList.remove("is-invalid");
    document.getElementById("categoria-Descripcion").classList.remove("is-invalid");
}

    </script>
</body>
</html>
