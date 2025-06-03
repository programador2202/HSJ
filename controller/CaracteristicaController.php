<?php

if (isset($_SERVER['REQUEST_METHOD'])) {

  require_once "../models/Caracteristica.php";
  $caracteristica = new Caracteristica();

  switch ($_SERVER["REQUEST_METHOD"]) {
    case "GET":
      header("Content-Type: application/json; charset=utf-8");

      //DEBEMOS IDENTIFICAR SI EL USUARIO REQUIERE LISTAR/BUSCAR
      if ($_GET["task"] == 'getAll') {
        echo json_encode($caracteristica->getAll());
      } else if ($_GET["task"] == 'getCategorias') {
        echo json_encode($caracteristica->getCategorias());
      } else if ($_GET["task"] == 'getSubCategorias') {
        echo json_encode($caracteristica->getSubCategorias($_GET['idCategoria']));
      } else if ($_GET["task"] == 'getMarcas') {
        echo json_encode($caracteristica->getMarcas($_GET['idSubCategoria']));
      } else if ($_GET["task"] == 'getBienesPorMarca') {
        echo json_encode($caracteristica->getBienesPorMarca($_GET['idMarca']));
      }else if ($_GET["task"] == 'getById') {
        echo json_encode($caracteristica->getById($_GET['idCaracteristica']));
      }
      break;

    case "POST":
      //Obtener los datos enviados
      $input = file_get_contents("php://input");
      $dataJSON = json_decode($input, true);

      //creamos un array asociativo con lo datos del nuevo registro 
      $registro = [
        "segmento" => $dataJSON["segmento"],
        "idBien" => $dataJSON["idBien"],

      ];
      //Obtenemos el número de registros
      $filasAfectadas = $caracteristica->add($registro);

      //Notificamos al usuario el número de filas en formato JSON
      header("Content-Type: application/json; charset=utf-8");
      echo json_encode(["filas" => $filasAfectadas]);
      break;

    case "PUT":
      $input = file_get_contents("php://input");
      $dataJSON = json_decode($input, true);

      $registro = [
        "idCaracteristica" => $dataJSON["idCaracteristica"],
        "segmento" => $dataJSON["segmento"],
        "idBien"    =>$dataJSON["idBien"],
      ];

      $filasAfectadas = $caracteristica->update($registro);
      header("Content-Type: application/json; charset=utf-8");
      echo json_encode(["filas" => $filasAfectadas]);
      break;

    case "DELETE":
      header("Content-Type: application/json; charset=utf-8");
      //El usuario enviará el id en la url => miurl.com/ideliminar
      //PASO 1: Obtener la URL desde el cliente
      $url = $_SERVER['REQUEST_URI'];
      //Paso 2: convertir la URL en un array
      $arrayURL = explode('/', $url);
      //paso 3: obtener el id
      $idcaracteristica = end($arrayURL);

      $filasafectadas = $caracteristica->delete(['idCaracteristica' => $idcaracteristica]);
      echo json_encode(['filas' => $filasafectadas]);
      break;

  }

}