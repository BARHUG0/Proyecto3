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
