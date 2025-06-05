<?php
include '../menu/index.php'
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Document</title>
</head>
<body>

<!--FIN DE NAVBAR-->
    <div class="container my-5">
      <h2 class="text-center mt-3">GESTIÓN DE MARCAS</h2>
        <button id="pgaddmarca" type="button" onclick="window.location.href='././RegistrarMarcas.php'" class="btn btn-success"><i class="fa-solid fa-plus"></i> NUEVA MARCA</button>
        <hr>
        <div class="card mt-3">
            <div class="card-header bg-info"><strong>MARCAS REGISTRADAS</strong></div>
            <div class="card-body">
                <table class="table table-bordered table-striped w-100" id="tabla-marcas">
                    <colgroup>
                    <col style="width:10%;"><!--idMarca-->
                    <col style="width:25%;"><!--marca-->
                    <col style="width:30%;"><!--SubCategorias-->
                    <col style="width:25%;"><!--Categorias-->
                    <col style="width:10%;"><!--Acciones-->

                    </colgroup>
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Marca</th>
                            <th>SubCategoría</th>
                            <th>Categoría</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Las marcas se cargarán aquí dinámicamente -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>
   //acceso global
   //OBTENEMOS TODOS LOS DATOS
  const tabla=document.querySelector("#tabla-marcas tbody");
  function obtenerMarcas(){
     
    //fetch(RUTA_CONTROLADOR).then(JSON).then(DATA).catch(ERRORES)
    fetch(`../../controller/MarcaController.php?task=getAll`,{
      method:'GET'
    })
    .then(response =>{return response.json()})
    .then(data =>{
      tabla.innerHTML=``;
      data.forEach(element => {
        tabla.innerHTML+=`
        <tr>
          <td>${element.idMarca}</td>
          <td>${element.marca}</td>
          <td>${element.subCategoria}</td>
          <td>${element.categoria}</td>

          <td>
          
              <a href='editarMarcas.php?id=${element.idMarca}' title='Editar' class='btn btn-info btn-sm edit'><i class="fa-solid fa-pencil"></i></a>
              <a href='#' title='Eliminar' data-idmarca='${element.idMarca}' class='btn btn-danger btn-sm delete'><i class="fa-solid fa-trash"></i></a>
              
            </td>

          </tr> 
          `;
        });
      })
      .catch(error =>{console.error(error)});
    }
  document.addEventListener("DOMContentLoaded",()=>{
    obtenerMarcas();

    tabla.addEventListener("click",(event)=>{

      const enlace=event.target.closest('a');//referencia a la etiqueta <a> mas cercana
      if(enlace && enlace.classList.contains('delete')){
        event.preventDefault();
        const idmarca=enlace.getAttribute('data-idmarca');
          if(confirm("¿Está seguro de eliminar el registro?")){
            fetch(`../../controller/MarcaController.php/${idmarca}`,{method:'DELETE'})
            .then(response =>{return response.json()})
            .then(datos=>{
              if(datos.filas>0){
                const filaEliminar=enlace.closest('tr');
                if (filaEliminar){filaEliminar.remove();}
              }
            })
            .catch(error=>{console.error(error)});
          }
      }
    });
  })
</script>
</body>
</html>
