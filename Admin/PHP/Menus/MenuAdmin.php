<?php
session_start();
if (!isset($_SESSION['idRol']) || $_SESSION['idRol'] != 1) {
    header("Location: ../../../Cliente/PHP/login2.php");
    exit();
}

require_once(__DIR__ . "/../coneccion/conector.php");
$obj = new Conectar();
$conexion = $obj->getConexion();

$menus = obtenerMenusPorRol(1, $conexion);

function obtenerMenusPorRol($idRol, $conexion) {
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
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard - SPORTFLEXX</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="../estilos/stylesAdmin.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            background-color: #f4f4f4;
        }

        .chart-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: space-around;
        }

        .chart-container canvas {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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
                    <div class="chart-container">
                        <canvas id="ventasChart"></canvas>
                        <canvas id="categoriasChart"></canvas>
                        <canvas id="clientesChart"></canvas>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="../js/scripts.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            fetch('obtenerDatosGraficos.php')
                .then(response => response.json())
                .then(data => {
                    const ventasData = data.ventas.map(item => item.Total);
                    const ventasLabels = data.ventas.map(item => item.Fecha);

                    const categoriasData = data.categorias.map(item => item.Total);
                    const categoriasLabels = data.categorias.map(item => item.Categoria);

                    const clientesData = data.clientes.map(item => item.Total);
                    const clientesLabels = data.clientes.map(item => item.Sexo);

                    const ventasChart = new Chart(document.getElementById('ventasChart'), {
                        type: 'line',
                        data: {
                            labels: ventasLabels,
                            datasets: [{
                                label: 'Ventas Totales',
                                data: ventasData,
                                borderColor: '#17a2b8',
                                fill: false,
                                tension: 0.1
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                title: {
                                    display: true,
                                    text: 'Ventas por Fecha'
                                },
                                tooltip: {
                                    mode: 'index',
                                    intersect: false
                                }
                            },
                            interaction: {
                                mode: 'nearest',
                                axis: 'x',
                                intersect: false
                            },
                            scales: {
                                x: {
                                    display: true,
                                    title: {
                                        display: true,
                                        text: 'Fecha'
                                    }
                                },
                                y: {
                                    display: true,
                                    title: {
                                        display: true,
                                        text: 'Ventas'
                                    }
                                }
                            }
                        }
                    });

                    const categoriasChart = new Chart(document.getElementById('categoriasChart'), {
                        type: 'bar',
                        data: {
                            labels: categoriasLabels,
                            datasets: [{
                                label: 'Total de Productos',
                                data: categoriasData,
                                backgroundColor: '#6f42c1'
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                title: {
                                    display: true,
                                    text: 'Productos por Categoría'
                                },
                                legend: {
                                    display: false
                                }
                            },
                            scales: {
                                x: {
                                    display: true,
                                    title: {
                                        display: true,
                                        text: 'Categoría'
                                    }
                                },
                                y: {
                                    display: true,
                                    title: {
                                        display: true,
                                        text: 'Productos'
                                    },
                                    beginAtZero: true
                                }
                            }
                        }
                    });

                    const clientesChart = new Chart(document.getElementById('clientesChart'), {
                        type: 'doughnut',
                        data: {
                            labels: clientesLabels,
                            datasets: [{
                                data: clientesData,
                                backgroundColor: ['#007bff', '#dc3545'],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                title: {
                                    display: true,
                                    text: 'Clientes por Sexo'
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function(tooltipItem) {
                                            return tooltipItem.label + ': ' + tooltipItem.raw;
                                        }
                                    }
                                }
                            }
                        }
                    });
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                });
        });
    </script>
</body>
</html>
