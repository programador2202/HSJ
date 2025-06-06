<?php
require_once "../config/Database.php";

class Bien
{
    private $conexion;

    public function __construct()
    {
        $this->conexion = Database::getConexion();
    }

    public function getAll(): array
    {
        $sql = "SELECT * FROM vista_bienes_registrados";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCategorias(): array
    {
        $sql = "SELECT * FROM CATEGORIAS";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getSubCategorias($idCategoria): array
    {
        $sql = "SELECT * FROM vista_subcategorias_con_categorias WHERE idCategoria = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([$idCategoria]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMarcas($idSubCategoria): array
    {
        $sql = "SELECT * FROM vista_marcas_bien WHERE idSubCategoria = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([$idSubCategoria]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUsuarios(): array
    {
        $sql = "SELECT * FROM USUARIOS";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function add($params = []): int
    {
        $sql = "CALL spu_bienes_registrar (?,?,?,?,?,?,?)";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([
            $params["condicion"],
            $params["modelo"],
            $params["numSerie"],
            $params["descripcion"],
            $params["fotografia"],
            $params["idMarca"],
            $params["idUsuario"]
        ]);
        return $stmt->rowCount();
    }

    public function update($params = []): int
    {
        $sql = "UPDATE BIENES SET 
                    condicion = ?, 
                    modelo = ?, 
                    numserie = ?, 
                    descripcion = ?, 
                    fotografia = ?, 
                    idmarca = ?, 
                    usuario = ?
                WHERE idbien = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([
            $params["condicion"],
            $params["modelo"],
            $params["numSerie"],
            $params["descripcion"],
            $params["fotografia"],
            $params["idMarca"],
            $params["idUsuario"],
            $params["idBien"]
        ]);
        return $stmt->rowCount();
    }

    public function delete($params = []): int
    {
        $sql = "DELETE FROM BIENES WHERE idbien = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([$params["idBien"]]);
        return $stmt->rowCount();
    }

    public function getById($idbien): array
    {
        // Incluye campos relacionados mediante una vista o joins
        $sql = "SELECT 
                    b.idbien, b.modelo, b.numserie, b.descripcion, b.condicion, b.fotografia,
                    b.idmarca, b.usuario AS idUsuario,
                    m.idsubcategoria, s.idcategoria
                FROM BIENES b
                INNER JOIN MARCAS m ON m.idmarca = b.idmarca
                INNER JOIN SUBCATEGORIAS s ON s.idsubcategoria = m.idsubcategoria
                WHERE b.idbien = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([$idbien]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
