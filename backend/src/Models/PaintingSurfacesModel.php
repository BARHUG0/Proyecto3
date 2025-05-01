<?php

class PaintingSurfaces
{
    private $conn;
    private $table = 'painting_surfaces';

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Obtener todas las relaciones entre pinturas y superficies
    public function getAllRelations()
    {
        $query = "SELECT * FROM " . $this->table;
        $stmt  = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Crear una nueva relación entre pintura y superficie
    public function createRelation($painting_id, $surface_id)
    {
        $query = "INSERT INTO " . $this->table . " (painting_id, surface_id) VALUES (:painting_id, :surface_id)";
        $stmt  = $this->conn->prepare($query);
        $stmt->bindParam(':painting_id', $painting_id);
        $stmt->bindParam(':surface_id', $surface_id);
        $stmt->execute();
    }
}
