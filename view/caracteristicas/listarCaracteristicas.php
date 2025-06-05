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
 
    <div class="container mt-5">
      <h2 class="text-center">CARACTETISTICAS REGISTRADAS</h2>
      <button id="pgaddcaracteristicas" type="button" onclick="window.location.href='././registrarCaracteristicas.php'" class="btn btn-success" ><i class="fa-solid fa-plus"></i> AGREGAR CARACTERISTICAS</button>
    
    <hr>
    <div class="card mt-3">
      <div class="card-header bg-primary text-white"><strong>CARACTERISTICAS REGISTRADAS</strong></div>
      <div class="card-body">
        <table class="table table-bordered table-striped w-100" id="tabla-Caracteristica">
            <colgroup>
            <col style="width:10%;"><!--id-->
            <col style="width:35%;"><!--Segmento-->
            <col style="width:35%;"><!--Bien-->
            <col style="width:20%;"><!--Acciones-->

            </colgroup>
          <thead>
            <tr>
              <th>ID</th>
              <th>Segmento</th>
              <th>Bien</th>
              <th>Acciones</th>

            </tr>
          </thead>
  
          <tbody>
          <!-- Contenido de forma dinámica -->
          </tbody>
  
        </table>
      </div>
    </div>
    </div>
    <script>
           //acceso global
   //OBTENEMOS TODOS LOS DATOS
  const tabla=document.querySelector("#tabla-Caracteristica tbody");
  function obtenerDatos(){
    //fetch(RUTA_CONTROLADOR).then(JSON).then(DATA).catch(ERRORES)
    fetch(`../../controller/CaracteristicaController.php?task=getAll`,{
      method:'GET'
    })
    .then(response =>{return response.json()})
    .then(data =>{
      tabla.innerHTML=``;
      data.forEach(element => {
        tabla.innerHTML+=`
        <tr>
          <td>${element.idCaracteristica}</td>
          <td>${element.segmento}</td>
          <td>
            <div class="ms-3">
              <span class="info-line"><b>Categoria:</b> ${element.categoria}</span><br>
              <span class="info-line"><b>Subcategoria:</b> ${element.subCategoria}</span><br>
              <span class="info-line"><b>Marca:</b> ${element.marca}</span><br>
              <span class="info-line"><b>Modelo:</b> ${element.modelo}</span><br>
              <span class="info-line"><b>N° Serie:</b> ${element.numSerie}</span><br>
              <span class="info-line"><b>Descripción:</b> ${element.descripcion}</span>
            </div>
          </td> 

          <td>
          
            <a href='editarCaracteristicas.php?id=${element.idCaracteristica}' title='Editar' class='btn btn-info btn-sm edit'><i class="fa-solid fa-pencil"></i></a>
            <a href='#' title='Eliminar' data-idcaracteristica='${element.idCaracteristica}' class='btn btn-danger btn-sm delete'><i class="fa-solid fa-trash"></i></a>
            
          </td>

        </tr>
        `;
      });
    })
    .catch(error =>{console.error(error)});
  }
  document.addEventListener("DOMContentLoaded",()=>{
    obtenerDatos();
    //¿comó enlazar un evento(click) a un control que NO existe?
    //RPTA:Delegación de evento(funcion asíncronas)
    tabla.addEventListener("click",(event)=>{
      //solo debemos detectar el CLICK en el botón(Eliminar= .delete)

      //CSS=> "pointer-events:none"
      const enlace=event.target.closest('a');//referencia a la etiqueta <a> mas cercana
      //¿Existe el enlace?, ¿El enlace tiene la clase "delete"?
      if(enlace && enlace.classList.contains('delete')){
        event.preventDefault();
        const idcaracteristica=enlace.getAttribute('data-idcaracteristica');
          if(confirm("¿Está seguro de eliminar el registro?")){
            fetch(`../../controller/CaracteristicaController.php/${idcaracteristica}`,{method:'DELETE'})
            .then(response =>{return response.json()})
            .then(datos=>{
              if(datos.filas>0){
                //forma 1: renderizar toda la tabl
                //obtenerDatos();
                //forma 2: Eliminar de la fila
                const filaEliminar=enlace.closest('tr');
                if (filaEliminar){filaEliminar.remove();}
              }
            })
            .catch(error=>{console.error(error)});
          }
      }
    });
  });
    </script>
</body>
</html>