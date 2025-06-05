<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Menú Horizontal</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    body {
      padding-top: 40px; /* espacio para navbar fija */
    }
    .navbar-nav .nav-link.active {
      background-color: #495057;
      border-radius: 5px;
      color: white !important;
    }
  </style>
</head>
<body>

<!-- Menú superior -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><i class="bi bi-pc-display"></i> Inventario</a>
    <button
      class="navbar-toggler"
      type="button"
      data-bs-toggle="collapse"
      data-bs-target="#navbarContenido"
      aria-controls="navbarContenido"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarContenido">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">

        <!-- Bienes -->
        <li class="nav-item"><a class="nav-link" href="../../view/bienes/listarBien.php">Bienes</a></li>
        <li class="nav-item"><a class="nav-link" href="../../view/asignaciones/listarAsignaciones.php">Asignaciones</a></li>
        <li class="nav-item"><a class="nav-link" href="../../view/caracteristicas/listarCaracteristicas.php">Características</a></li>
        <li class="nav-item"><a class="nav-link" href="../../view/detalles/listarDetalles.php">Detalle</a></li>

        <!-- Personas -->
        <li class="nav-item"><a class="nav-link" href="../../view/personas/ListarPersonas.php">Persona</a></li>
        <li class="nav-item"><a class="nav-link" href="../../view/usuarios/listarUsuarios.php">Usuario</a></li>
        <li class="nav-item"><a class="nav-link" href="../../view/colaboradores/listarColaboradores.php">Colaboradores</a></li>

        <!-- Opciones simples -->
        <li class="nav-item"><a class="nav-link" href="../../view/categorias/listarCategoria.php">Categoría</a></li>
        <li class="nav-item"><a class="nav-link" href="../../view/SubCategoria/ListarSubcategorias.php">Subcategoría</a></li>
        <li class="nav-item"><a class="nav-link" href="../../view/marcas/ListarMarcas.php">Marcas</a></li>
        <li class="nav-item"><a class="nav-link" href="../../view/areas/listarArea.php">Área</a></li>
        <li class="nav-item"><a class="nav-link" href="../../view/roles/ListarRoles.php">Rol</a></li>
        <li class="nav-item"><a class="nav-link" href="../../view/configuracion/listarConfiguracion.php">Configuraciones</a></li>

      </ul>
    </div>
  </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  // Activar enlace actual basado en la URL
  document.addEventListener('DOMContentLoaded', function () {
    const currentURL = window.location.pathname.split('/').pop();
    document.querySelectorAll('.nav-link').forEach(link => {
      const href = link.getAttribute('href');
      if (href && href.includes(currentURL)) {
        link.classList.add('active');
      }
    });
  });
</script>
</body>
</html>

