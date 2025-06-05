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
    <div class="container my-5">
        <form action="" method="" id="formulario-registrar" >
            <h2 class="text-center mb-4">Agregar Caracteristicas</h2>
            <button id="vlvlstAsignacion" type="button" onclick="window.location.href='././listarCaracteristicas.php'" class="btn btn-success"><i class="fa-solid fa-arrow-left"></i> VOLVER</button>
            <div class="card mt-3">
                <div class="card-header bg-primary text-white"><strong>REGISTRAR</strong></div>
                <div class="card-body">
                    <div class="row">
                    <div class="col-md-12 mb-3">
                        <div class="form-floating">
                            <input type="text" id="segmento" name="caracteristica" class="form-control" placeholder="Segmento" required>
                            <label for="segmento" class="form-label">Segmento:</label>
                    </div>
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="form-floating">
                        <select id="Categoria" class="form-select" required>
                            <option value="">Seleccione Categoria:</option>
                        </select>
                        <label for="Categoria" class="form-label">Seleccionar Categoria:</label>
                    </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-floating">
                        <select id="SubCategoria" class="form-select" required>
                            <option value="">Seleccione Subcategoria:</option>
                        </select>
                        <label for="SubCategoria" class="form-label">Seleccionar Subcategoria:</label>
                    </div>
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-md-12 mb-3">
                        <div class="form-floating">
                        <select id="marca" class="form-select" required>
                            <option value="">Seleccione Marca:</option>
                        </select>
                        <label for="marca" class="form-label">Seleccionar Marcas:</label>
                    </div>
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-md-12 mb-3">
                        <div class="form-floating">
                        <select id="bienes" class="form-select" required>
                            <option value="">Seleccione Bien:</option>
                        </select>
                        <label for="bienes" class="form-label">Seleccionar Bien:</label>
                    </div>
                    </div>
                    </div>
                </div>
                <div class="card-footer d-grid gap-2">
                    <button class="btn btn-primary" id="addCaracteristica">Agregar</button>
                </div>
            </div>
        </form>
    </div>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const categoriaSelect = document.querySelector("#Categoria");
        const subCategoriaSelect = document.querySelector("#SubCategoria");
        const marcaSelect = document.querySelector("#marca");
        const bienes = document.querySelector("#bienes");


      // Cargar Categorías
      fetch("../../controller/CaracteristicaController.php?task=getCategorias")
        .then(response => response.json())
        .then(data => {
          data.forEach(categoria => {
            categoriaSelect.innerHTML += `<option value="${categoria.idCategoria}">${categoria.categoria}</option>`;
          });
        });

      // 👇 Este es el nuevo código para cargar subcategorías
      categoriaSelect.addEventListener("change", () => {
        const idCategoria = categoriaSelect.value;

        // Limpiar subcategorías anteriores
        subCategoriaSelect.innerHTML = '<option value="">Selecciona una Subcategoria</option>';


        fetch(`../../controller/CaracteristicaController.php?task=getSubCategorias&idCategoria=${idCategoria}`)
          .then(response => response.json())
          .then(data => {
            data.forEach(subcategoria => {
              subCategoriaSelect.innerHTML += `<option value="${subcategoria.idSubCategoria}">${subcategoria.subCategoria}</option>`;
            });
          })
          .catch(error => {
            console.error(error);
          });
      });

      //  Este es el código para cargar marcas
      subCategoriaSelect.addEventListener("change", () => {
        const idsubCategoria = subCategoriaSelect.value;

        // Limpiar subcategorías anteriores
        marcaSelect.innerHTML = '<option value="">Selecciona una Marca</option>';

        fetch(`../../controller/CaracteristicaController.php?task=getMarcas&idSubCategoria=${idsubCategoria}`)
          .then(response => response.json())
          .then(data => {
            data.forEach(marcas => {
              marcaSelect.innerHTML += `<option value="${marcas.idMarca}">${marcas.marca}</option>`;
            });
          })
          .catch(error => {
            console.error(error);
          });
      });

      marcaSelect.addEventListener("change", () => {
        const idMarca = marcaSelect.value;

        // Limpiar bienes anteriores
        bienes.innerHTML = '<option value="">Seleccionar Bien</option>';

        fetch(`../../controller/CaracteristicaController.php?task=getBienesPorMarca&idMarca=${idMarca}`)
          .then(response => response.json())
          .then(data => {
            data.forEach(bien => {
              bienes.innerHTML += `<option value="${bien.idBien}">${bien.modelo} ${bien.numSerie} ${bien.descripcion}</option>`;
            });
          })
          .catch(error => {
            console.error(error);
          });
      });



     
    });

    //NUEVO REGISTRO
    const formulario = document.querySelector("#formulario-registrar");
    function registrarCaracteristica() {
      const idBien = parseInt(document.querySelector('#bienes').value);
      const segmento=document.querySelector("#segmento").value


      fetch(`../../controller/CaracteristicaController.php`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
            segmento,
            idBien,
        })
      })
        .then(response => response.json())
        .then(data => {
          if (data.filas > 0) {
            formulario.reset();
            alert("Guardado correctamente");
          } else {
            alert("Error al guardar. Intente nuevamente.");
          }
        })
        .catch(error => {
          console.error(error);
          alert("Error de red o servidor.");
        });
    }

    //formulario=botonb[submit](validar Front)
    formulario.addEventListener("submit", function (event) {
      event.preventDefault();//cancela el evento

      if (confirm("¿Está seguro de registrar?")) {
        registrarCaracteristica();
      }
    });

  </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

</body>

</html>