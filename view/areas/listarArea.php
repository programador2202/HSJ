<?php
include '../index.php'
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
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body>
<div class="container ">
   
<h2 class="text-center mt-3">GESTIÓN DE AREAS</h2>
  <button id="pgaddArea" type="button" onclick="window.location.href='././registrarArea.php'" class="btn btn-success"><i class="fa-solid fa-plus"></i> NUEVA AREA </button>
    <hr>

  <div class="card mt-3">
    <div class="card-header bg-info"><strong>ÁREAS REGISTRADAS</strong></div>
    <div class="card-body">
      <table class="table table-bordered table-striped w-100" id="tabla-Areas">
        <colgroup>
          <col style="width:15%;"><!--idArea-->
          <col style="width:65%;"><!--Area-->
          <col style="width:20%;"><!--acciones-->
        </colgroup>
        <thead>
          <tr>
            <th>ID</th>
            <th>AREA</th>
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
   //acceso global
   //OBTENEMOS TODOS LOS DATOS
  const tabla=document.querySelector("#tabla-Areas tbody");
  function obtenerDatos(){
    //fetch(RUTA_CONTROLADOR).then(JSON).then(DATA).catch(ERRORES)
    fetch(`../../controller/AreaController.php?task=getAll`,{
      method:'GET'
    })
    .then(response =>{return response.json()})
    .then(data =>{
      tabla.innerHTML=``;
      data.forEach(element => {
        tabla.innerHTML+=`
        <tr>
          <td>${element.idArea}</td>
          <td>${element.area}</td>
          <td>
          
            <a href='editarArea.php?id=${element.idArea}' title='Editar' class='btn btn-info btn-sm edit'><i class="fa-solid fa-pencil"></i></a>
            <a href='#' title='Eliminar' data-idarea='${element.idArea}' class='btn btn-danger btn-sm delete'><i class="fa-solid fa-trash"></i></a>
            
          </td>

        </tr>
        `;
      });
    })
    .catch(error =>{console.error(error)});
  }
    document.addEventListener("DOMContentLoaded", () => {
        obtenerDatos();

        tabla.addEventListener("click", (event) => {
            const enlace = event.target.closest('a');
            if (enlace && enlace.classList.contains('delete')) {
                event.preventDefault();
                const idarea = enlace.getAttribute('data-idarea');
                Swal.fire({
                    title: '¿Está seguro?',
                    text: '¡No podrá revertir esta acción!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Sí, eliminarlo',
                    cancelButtonText: 'No, cancelar',
                    reverseButtons: true,
                    customClass: {
                        confirmButton: 'btn btn-success',
                        cancelButton: 'btn btn-danger'
                    },
                    buttonsStyling: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(`../../controller/AreaController.php/${idarea}`, { method: 'DELETE' })
                            .then(response => response.json())
                            .then(datos => {
                                if (datos.filas > 0) {
                                    const filaEliminar = enlace.closest('tr');
                                    if (filaEliminar) filaEliminar.remove();
                                    Swal.fire({
                                        title: '¡Eliminado!',
                                        text: 'El área ha sido eliminada.',
                                        icon: 'success',
                                        customClass: { confirmButton: 'btn btn-success' },
                                        buttonsStyling: false
                                    });
                                }
                            })
                            .catch(error => console.error(error));
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        Swal.fire({
                            title: 'Cancelado',
                            text: 'Eliminació cancelada',
                            icon: 'error',
                            customClass: { confirmButton: 'btn btn-danger' },
                            buttonsStyling: false
                        });
                    }
                });
            }
        });
    });
</script>
</body>
</html>



