<?php
include '../index.php'
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>
  <div class="container">
    <form action="" autocomplete="off" id="formulario-registrar">
      <h2 class="text-center mt-3">REGISTRAR CATEGORIA</h2>
      <button id="listadocategorias" type="button" onclick="window.location.href='././listarCategoria.php'" class="btn btn-success"><i class="fa-solid fa-arrow-left"></i> VOLVER </button>
      <hr>
      <div class="card mt-3">
        <div class="card-header bg-info"><strong>REGISTRAR CATEGORIA</strong></div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-12 mb-2">
              <div class="form-floating">
                <input type="text" id="categoria" name="categoria" class="form-control" placeholder="Categoria"
                  required>
                <label for="categoria" class="form-label">Categoria:</label>
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer d-grid gap-2">
          <button class="btn btn-primary" id="addCategoria" type="submit">Agregar Categoria</button>
        </div>
      </div>
    </form>
  </div>

  <script>
    //AGREGAMOS UN REGISTRO
    const formulario = document.querySelector("#formulario-registrar");

    function registrarCategoria() {
      fetch(`../../controller/CategoriaController.php`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
          categoria: document.querySelector('#categoria').value,
        })
      })
        .then(response => { return response.json() })
        .then(data => {
          if (data.filas > 0) {
            formulario.reset();
            Swal.fire({
              title: 'CONFIRMADO',
              text: 'Categoria Registrada',
              icon: 'success',
              footer: 'SENATI ING. SOFTWARE',
              confirmButtonText: 'OK',
              confirmButtonColor: '#2980b9',
            })
          }
        })
        .catch(error => { console.error(error) });
    }
    //formulario=botonb[submit](validar Front)
    formulario.addEventListener("submit", function (event) {
      event.preventDefault();//cancela el evento

      Swal.fire({
        title: 'CATEGORIA',
        text: '¿Está seguro de registrar?',
        icon: 'question',
        footer: 'SENATI ING. SOFTWARE',
        confirmButtonText: 'Aceptar',
        confirmButtonColor: '#2980b9',
        showCancelButton: true,
        cancelButtonText: 'cancelar'
      }).then((result) => {
        if (result.isConfirmed) {
          registrarCategoria();
        }
      })
    });

  </script>
</body>

</html>