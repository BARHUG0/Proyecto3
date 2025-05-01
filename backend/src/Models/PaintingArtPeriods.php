<?php

class PaintingArtPeriods
{
    private $conn;
    private $table = 'painting_art_periods';

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Obtener todas las relaciones entre pinturas y periodos artísticos
    public function getAllRelations()
    {
        $query = "SELECT * FROM " . $this->table;
        $stmt  = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Crear una nueva relación entre pintura y periodo artístico
    public function createRelation($painting_id, $art_period_id)
    {
        $query = "INSERT INTO " . $this->table . " (painting_id, art_period_id) VALUES (:painting_id, :art_period_id)";
        $stmt  = $this->conn->prepare($query);
        $stmt->bindParam(':painting_id', $painting_id);
        $stmt->bindParam(':art_period_id', $art_period_id);
        $stmt->execute();
    }
}
