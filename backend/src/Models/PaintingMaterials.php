<?php

class PaintingMaterials
{
    private $conn;
    private $table = 'painting_materials';

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Obtener todas las relaciones entre pinturas y materiales
    public function getAllRelations()
    {
        $query = "SELECT * FROM " . $this->table;
        $stmt  = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMaterialsByPaintingReport()
    {
        $query = "SELECT p.title, m.name  FROM painting_materials AS pm JOIN painting AS p ON p.id = pm.painting_id JOIN material AS m ON m.id = pm.material_id ORDER BY p.title, m.name";
        $stmt  = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }



    // Crear una nueva relación entre pintura y material
    public function createRelation($painting_id, $material_id)
    {
        $query = "INSERT INTO " . $this->table . " (painting_id, material_id) VALUES (:painting_id, :material_id)";
        $stmt  = $this->conn->prepare($query);
        $stmt->bindParam(':painting_id', $painting_id);
        $stmt->bindParam(':material_id', $material_id);
        $stmt->execute();
    }
}
