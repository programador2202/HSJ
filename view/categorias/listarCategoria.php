<?php
include '../menu/index.php'
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   <!--Font Awesone-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>

<div class="container mt-5">
   <h2 class="text-center mt-3">GESTIÓN DE CATEGORIAS</h2>
  <button id="pgaddCategoria" type="button" onclick="window.location.href='././registrarCategoria.php'" class="btn btn-success"><i class="fa-solid fa-plus"></i> NUEVA CATEGORIA</button>
    <hr>

  <div class="card mt-3">
    <div class="card-header bg-info"><strong>CATEGORIAS REGISTRADAS</strong></div>
    <div class="card-body">
      <table class="table table-bordered table-striped w-100" id="tabla-Categorias">
        <colgroup>
          <col style="width:15%;"><!--idCategoria-->
          <col style="width:65%;"><!--categoria-->
          <col style="width:20%;"><!--acciones-->
        </colgroup>
        <thead>
          <tr>
            <th>ID</th>
            <th>CATEGORIA</th>
            <th>ACCIONES</th>

          </tr>
        </thead>

        <tbody>
        <!-- Contenido de forma dinámica -->
        </tbody>

      </table>
    </div>
  </div>

<script>
  const tabla = document.querySelector("#tabla-Categorias tbody");

  // Obtener datos al cargar
  function obtenerDatos() {
    fetch(`../../controller/CategoriaController.php?task=getAll`)
      .then(response => response.json())
      .then(data => {
        tabla.innerHTML = ``;
        data.forEach(element => {
          tabla.innerHTML += `
            <tr>
              <td>${element.idCategoria}</td>
              <td>${element.categoria}</td>
              <td>
                <a href='editarCategoria.php?id=${element.idCategoria}' class='btn btn-info btn-sm edit' title='Editar'><i class="fa-solid fa-pencil"></i></a>
                <a href='#' data-idcategoria='${element.idCategoria}' class='btn btn-danger btn-sm delete' title='Eliminar'><i class="fa-solid fa-trash"></i></a>
              </td>
            </tr>`;
        });
      })
      .catch(error => console.error(error));
  }

  // Eliminar con confirmación de SweetAlert
  tabla.addEventListener("click", event => {
    const enlace = event.target.closest('a');
    if (enlace && enlace.classList.contains('delete')) {
      event.preventDefault();
      const idcategoria = enlace.getAttribute('data-idcategoria');

      Swal.fire({
        title: '¿Está seguro?',
        text: "¡No podrá revertir esta acción!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
      }).then((result) => {
        if (result.isConfirmed) {
          fetch(`../../controller/CategoriaController.php/${idcategoria}`, {
            method: 'DELETE'
          })
          .then(response => response.json())
          .then(datos => {
            if (datos.filas > 0) {
              const filaEliminar = enlace.closest('tr');
              if (filaEliminar) filaEliminar.remove();
              Swal.fire('¡Eliminado!', 'La categoría ha sido eliminada.', 'success');
            } else {
              Swal.fire('Error', 'No se pudo eliminar la categoría.', 'error');
            }
          })
          .catch(error => {
            console.error(error);
            Swal.fire('Error', 'Hubo un problema al eliminar.', 'error');
          });
        }
      });
    }
  });

  document.addEventListener("DOMContentLoaded", () => {
    obtenerDatos();

    // Mensaje tras redirección de registro o edición
    const params = new URLSearchParams(window.location.search);
    const msg = params.get('msg');

    if (msg === 'insert') {
      Swal.fire('¡Registrado!', 'Categoría registrada correctamente.', 'success');
    }
    if (msg === 'update') {
      Swal.fire('¡Actualizado!', 'Categoría actualizada correctamente.', 'success');
    }
  });
</script>

</body>
</html>
