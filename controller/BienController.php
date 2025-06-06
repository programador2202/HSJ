<?php

if (isset($_SERVER['REQUEST_METHOD'])) {
    require_once "../models/Bien.php";
    $bien = new Bien();

    switch ($_SERVER["REQUEST_METHOD"]) {
        case "GET":
            header("Content-Type: application/json; charset=utf-8");

            if ($_GET["task"] == 'getAll') {
                echo json_encode($bien->getAll());
            } else if ($_GET["task"] == 'getCategorias') {
                echo json_encode($bien->getCategorias());
            } else if ($_GET["task"] == 'getSubCategorias') {
                echo json_encode($bien->getSubCategorias($_GET['idCategoria']));
            } else if ($_GET["task"] == 'getMarcas') {
                echo json_encode($bien->getMarcas($_GET['idSubCategoria']));
            } else if ($_GET["task"] == 'getUsuarios') {
                echo json_encode($bien->getUsuarios());
            } else if ($_GET["task"] == 'getById') {
                echo json_encode($bien->getById($_GET['idBien']));
            }
            break;

        case "POST":
            $input = file_get_contents("php://input");
            $dataJSON = json_decode($input, true);

            $registro = [
                "condicion"   => $dataJSON["condicion"],
                "modelo"      => $dataJSON["modelo"],
                "numSerie"    => $dataJSON["numSerie"],
                "descripcion" => $dataJSON["descripcion"],
                "fotografia"  => $dataJSON["fotografia"],
                "idMarca"     => $dataJSON["idMarca"],
                "idUsuario"   => $dataJSON["idUsuario"],
            ];

            $filasAfectadas = $bien->add($registro);
            header("Content-Type: application/json; charset=utf-8");
            echo json_encode(["filas" => $filasAfectadas]);
            break;

        case "PUT":
            header("Content-Type: application/json; charset=utf-8");
            $input = file_get_contents("php://input");
            $dataJSON = json_decode($input, true);

            // Validación rápida
            if (!isset($dataJSON["idBien"])) {
                echo json_encode(["error" => "Falta el idBien para actualizar."]);
                exit;
            }

            $registro = [
                "idBien"      => $dataJSON["idBien"],
                "condicion"   => $dataJSON["condicion"],
                "modelo"      => $dataJSON["modelo"],
                "numSerie"    => $dataJSON["numSerie"],
                "descripcion" => $dataJSON["descripcion"],
                "fotografia"  => $dataJSON["fotografia"],
                "idMarca"     => $dataJSON["idMarca"],
                "idUsuario"   => $dataJSON["idUsuario"],
            ];

            $filasAfectadas = $bien->update($registro);
            echo json_encode(["filas" => $filasAfectadas]);
            break;

        case "DELETE":
            header("Content-Type: application/json; charset=utf-8");

            $url = $_SERVER['REQUEST_URI'];
            $arrayURL = explode('/', $url);
            $idbien = end($arrayURL);

            $filasAfectadas = $bien->delete(['idBien' => $idbien]);
            echo json_encode(['filas' => $filasAfectadas]);
            break;
    }
}
