<?php

class PaintingMovementsStyles
{
    private $conn;
    private $table = 'painting_movements_styles';

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Obtener todas las relaciones entre pinturas y estilos de movimiento
    public function getAllRelations()
    {
        $query = "SELECT * FROM " . $this->table;
        $stmt  = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Crear una nueva relación entre pintura y estilo de movimiento
    public function createRelation($painting_id, $movement_style_id)
    {
        $query = "INSERT INTO " . $this->table . " (painting_id, movement_style_id) VALUES (:painting_id, :movement_style_id)";
        $stmt  = $this->conn->prepare($query);
        $stmt->bindParam(':painting_id', $painting_id);
        $stmt->bindParam(':movement_style_id', $movement_style_id);
        $stmt->execute();
    }
}
