<?php
include '../menu/index.php'
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Editar Asignación</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>
<body>
  <div class="container mt-5">
    <form id="formulario-editar">
      <h2 class="text-center mb-4">EDITAR ASIGNACIÓN</h2>
      <button type="button" onclick="window.location.href='listarAsignaciones.php'" class="btn btn-success mb-3">
        <i class="fa-solid fa-arrow-left"></i> VOLVER
      </button>
      <div class="card">
        <div class="card-header bg-primary text-white"><strong>EDITAR</strong></div>
        <div class="card-body">
          <input type="hidden" id="idAsignacion" value="<?php echo $_GET['id'] ?? ''; ?>">

          <div class="row mb-3">
            <div class="col-md-12">
              <div class="form-floating">
                <select id="bienes" class="form-select" required>
                  <option value="">Seleccionar Bien</option>
                </select>
                <label for="bienes" class="form-label">Bien:</label>
              </div>
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-md-12">
              <div class="form-floating">
                <select id="colaboradores" class="form-select" required>
                  <option value="">Seleccionar colaborador</option>
                </select>
                <label for="colaboradores" class="form-label">Colaborador:</label>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6 mb-3">
              <div class="form-floating">
                <input type="date" class="form-control" id="inicio" name="inicio" required>
                <label for="inicio">Fecha Inicio:</label>
              </div>
            </div>
            <div class="col-md-6 mb-3">
              <div class="form-floating">
                <input type="date" class="form-control" id="fin" name="fin">
                <label for="fin">Fecha Final:</label>
              </div>
            </div>
          </div>
        </div>

        <div class="card-footer d-grid">
          <button type="submit" class="btn btn-primary text-white">ACTUALIZAR</button>
        </div>
      </div>
    </form>
  </div>

  <script>
    document.addEventListener("DOMContentLoaded", () => {
      const idAsignacion = document.querySelector('#idAsignacion').value;
      const bienes = document.querySelector('#bienes');
      const colaboradores = document.querySelector('#colaboradores');

      // Cargar colaboradores
      fetch("../../controller/AsignacionesController.php?task=getColaboradores")
        .then(res => res.json())
        .then(data => {
          data.forEach(colaborador => {
            colaboradores.innerHTML += `<option value="${colaborador.idColaborador}">${colaborador.nombres} ${colaborador.apellidos}</option>`;
          });
        });

      // Cargar bienes
      fetch("../../controller/AsignacionesController.php?task=getBienes")
        .then(res => res.json())
        .then(data => {
          data.forEach(bien => {
            bienes.innerHTML += `<option value="${bien.idBien}">${bien.modelo} ${bien.numSerie} ${bien.descripcion}</option>`;
          });
        });

      // Obtener datos de asignación por ID
      fetch(`../../controller/AsignacionesController.php?task=getById&id=${idAsignacion}`)
        .then(res => res.json())
        .then(data => {
          document.querySelector('#bienes').value = data.idBien;
          document.querySelector('#colaboradores').value = data.idColaborador;
          document.querySelector('#inicio').value = data.inicio;
          document.querySelector('#fin').value = data.fin;
        })
        .catch(error => {
          console.error("Error al obtener la asignación:", error);
        });

      // Actualizar asignación
      const formulario = document.querySelector("#formulario-editar");
      formulario.addEventListener("submit", function (e) {
        e.preventDefault();

        if (confirm("¿Desea guardar los cambios?")) {
          fetch("../../controller/AsignacionesController.php", {
            method: "PUT",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({
              idAsignacion: parseInt(idAsignacion),
              idBien: parseInt(bienes.value),
              idColaborador: parseInt(colaboradores.value),
              inicio: document.querySelector('#inicio').value,
              fin: document.querySelector('#fin').value
            })
          })
            .then(res => res.json())
            .then(data => {
              if (data.filas > 0) {
                alert("Asignación actualizada correctamente");
                window.location.href = "listarAsignaciones.php";
              } else {
                alert("No se pudo actualizar");
              }
            })
            .catch(err => {
              console.error("Error al actualizar:", err);
              alert("Error de red o servidor");
            });
        }
      });
    });
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
