<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Menú Principal</title>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<!-- Bootstrap Bundle JS (incluye Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold" href="#">
      <i class="bi bi-pc-display"></i> Inventario
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown">
      <span class="navbar-toggler-icon"></span> 
    </button>

    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">

       <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarBienes" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-box-seam"></i> Bienes
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarBienes">
            <li><a class="dropdown-item" href="../view/bienes/listarBien.php">Bienes</a></li>
            <li><a class="dropdown-item" href="../view/asignaciones/listarAsignaciones.php">Asignaciones</a></li>
            <li><a class="dropdown-item" href="../view/caracteristicas/listarCaracteristicas.php">Características</a></li>
            <li><a class="dropdown-item" href="../view/detalles/listarDetalles.php">Detalle</a></li>
          </ul>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarPersonas" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-person"></i> Personas
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarPersonas">
            <li><a class="dropdown-item" href="../view/personas/ListarPersonas.php">Persona</a></li>
            <li><a class="dropdown-item" href="../view/usuarios/listarUsuarios.php">Usuario</a></li>
            <li><a class="dropdown-item" href="../view/colaboradores/listarColaboradores.php">Colaboradores</a></li>
          </ul>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="../view/categorias/listarCategoria.php">
            <i class="bi bi-box"></i> Categoría
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="../view/SubCategoria/ListarSubcategorias.php">
            <i class="bi bi-tags"></i> Subcategoría
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="../view/marcas/ListarMarcas.php">
            <i class="bi bi-shop"></i> Marcas
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="../view/areas/listarArea.php">
            <i class="bi bi-house-door"></i> Área
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="../view/roles/ListarRoles.php">
            <i class="bi bi-people"></i> Rol
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link " href="../view/configuracion/listarConfiguracion.php">
            <i class="bi bi-slash-circle"></i> Configuraciones
          </a>
        </li>

      </ul>
    </div>
  </div>
</nav>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const currentURL = window.location.pathname.split('/').pop();

    document.querySelectorAll('.nav-link, .dropdown-item').forEach(link => {
      const href = link.getAttribute('href');
      if (href && href.includes(currentURL)) {
        link.classList.add('active');
      }
    });

    // Cierra el navbar en dispositivos móviles al hacer clic en un enlace
    const navLinks = document.querySelectorAll('.nav-link, .dropdown-item');
    const navbarCollapse = document.querySelector('.navbar-collapse');

    navLinks.forEach(link => {
      link.addEventListener('click', () => {
        if (navbarCollapse.classList.contains('show')) {
          const bsCollapse = bootstrap.Collapse.getInstance(navbarCollapse);
          bsCollapse.hide();
        }
      });
    });
  });
</script>

</body>
</html>
