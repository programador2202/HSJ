<?php
include '../menu/index.php';
$idBien = $_GET['id'] ?? null;
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Editar Bien</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
<div class="container my-5">
    <form id="form-editar-bien">
        <h2 class="text-center mt-5">EDITAR BIEN</h2>
        <button type="button" onclick="window.location.href='./listarBien.php'" class="btn btn-success mb-3">
            <i class="fa-solid fa-arrow-left"></i> VOLVER
        </button>
        <div class="card">
            <div class="card-header bg-primary text-white"><strong>EDITAR</strong></div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 mb-2">
                        <div class="form-floating">
                            <select id="categoria" class="form-select" required></select>
                            <label>Categoria</label>
                        </div>
                    </div>
                    <div class="col-md-4 mb-2">
                        <div class="form-floating">
                            <select id="subcategoria" class="form-select" required></select>
                            <label>Subcategoria</label>
                        </div>
                    </div>
                    <div class="col-md-4 mb-2">
                        <div class="form-floating">
                            <select id="marca" class="form-select" required></select>
                            <label>Marca</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <div class="form-floating">
                            <select id="condicion" class="form-select" required>
                                <option value="">Seleccione</option>
                                <option value="Bueno">Bueno</option>
                                <option value="Dañado">Dañado</option>
                                <option value="Reparación">Reparación</option>
                            </select>
                            <label>Condición</label>
                        </div>
                    </div>
                    <div class="col-md-6 mb-2">
                        <div class="form-floating">
                            <input type="text" id="modelo" class="form-control" required>
                            <label>Modelo</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <div class="form-floating">
                            <input type="text" id="numSerie" class="form-control" required>
                            <label>Número de Serie</label>
                        </div>
                    </div>
                    <div class="col-md-6 mb-2">
                        <div class="form-floating">
                            <input type="text" id="descripcion" class="form-control" required>
                            <label>Descripción</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <div class="form-floating">
                            <input type="text" id="fotografia" class="form-control">
                            <label>Fotografía</label>
                        </div>
                    </div>
                    <div class="col-md-6 mb-2">
                        <div class="form-floating">
                            <select id="idusuario" class="form-select" required></select>
                            <label>Usuario</label>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-grid gap-2">
                    <button class="btn btn-primary" type="submit">Actualizar Bien</button>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const idBien = <?= json_encode($idBien) ?>;
    const categoriaSelect = document.querySelector("#categoria");
    const subCategoriaSelect = document.querySelector("#subcategoria");
    const marcaSelect = document.querySelector("#marca");
    const usuarioSelect = document.querySelector("#idusuario");

    fetch(`../../controller/BienController.php?task=getById&idBien=${idBien}`)
        .then(r => r.json())
        .then(res => {
            const bien = res[0];
            document.querySelector("#modelo").value = bien.modelo;
            document.querySelector("#numSerie").value = bien.numserie;
            document.querySelector("#descripcion").value = bien.descripcion;
            document.querySelector("#condicion").value = bien.condicion;
            document.querySelector("#fotografia").value = bien.fotografia;

            cargarCategorias(bien.idCategoria, bien.idSubCategoria, bien.idMarca);
            cargarUsuarios(bien.idUsuario);
        });

    function cargarCategorias(idCategoria, idSubCategoria, idMarca) {
        fetch("../../controller/BienController.php?task=getCategorias")
            .then(r => r.json())
            .then(data => {
                categoriaSelect.innerHTML = `<option value="">Selecciona una Categoria</option>`;
                data.forEach(c => {
                    categoriaSelect.innerHTML += `<option value="${c.idCategoria}" ${c.idCategoria == idCategoria ? 'selected' : ''}>${c.categoria}</option>`;
                });
                cargarSubcategorias(idCategoria, idSubCategoria, idMarca);
            });
    }

    function cargarSubcategorias(idCategoria, idSubCategoria, idMarca) {
        fetch(`../../controller/BienController.php?task=getSubCategorias&idCategoria=${idCategoria}`)
            .then(r => r.json())
            .then(data => {
                subCategoriaSelect.innerHTML = `<option value="">Selecciona una Subcategoria</option>`;
                data.forEach(s => {
                    subCategoriaSelect.innerHTML += `<option value="${s.idSubCategoria}" ${s.idSubCategoria == idSubCategoria ? 'selected' : ''}>${s.subCategoria}</option>`;
                });
                cargarMarcas(idSubCategoria, idMarca);
            });
    }

    function cargarMarcas(idSubCategoria, idMarca) {
        fetch(`../../controller/BienController.php?task=getMarcas&idSubCategoria=${idSubCategoria}`)
            .then(r => r.json())
            .then(data => {
                marcaSelect.innerHTML = `<option value="">Selecciona una Marca</option>`;
                data.forEach(m => {
                    marcaSelect.innerHTML += `<option value="${m.idMarca}" ${m.idMarca == idMarca ? 'selected' : ''}>${m.marca}</option>`;
                });
            });
    }

    function cargarUsuarios(idUsuario) {
        fetch("../../controller/BienController.php?task=getUsuarios")
            .then(r => r.json())
            .then(data => {
                usuarioSelect.innerHTML = `<option value="">Seleccione Usuario</option>`;
                data.forEach(u => {
                    usuarioSelect.innerHTML += `<option value="${u.idUsuario}" ${u.idUsuario == idUsuario ? 'selected' : ''}>${u.nomUser}</option>`;
                });
            });
    }

    document.querySelector("#form-editar-bien").addEventListener("submit", e => {
        e.preventDefault();

        Swal.fire({
            title: '¿Actualizar bien?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Sí, actualizar',
            confirmButtonColor: '#3085d6',
            cancelButtonText: 'Cancelar'
        }).then(result => {
            if (result.isConfirmed) {
                fetch("../../controller/BienController.php", {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        idBien,
                        condicion: document.querySelector("#condicion").value,
                        modelo: document.querySelector("#modelo").value,
                        numSerie: document.querySelector("#numSerie").value,
                        descripcion: document.querySelector("#descripcion").value,
                        fotografia: document.querySelector("#fotografia").value,
                        idMarca: parseInt(document.querySelector("#marca").value),
                        idUsuario: parseInt(document.querySelector("#idusuario").value)
                    })
                })
                .then(r => r.json())
                .then(data => {
                    if (data.filas > 0) {
                        Swal.fire("Actualizado", "El bien fue actualizado con éxito", "success");
                    } else {
                        Swal.fire("Sin cambios", "No se realizó ninguna actualización", "info");
                    }
                })
                .catch(e => console.error("Error actualizando:", e));
            }
        });
    });
});
</script>
</body>
</html>
