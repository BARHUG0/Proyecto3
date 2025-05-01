<?php

class PaintingConditionSummary
{
    private $conn;
    private $table = 'painting_condition_summary';

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Obtener todos los resúmenes de condición de pintura
    public function getAllSummaries()
    {
        $query = "SELECT * FROM " . $this->table;
        $stmt  = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Crear un nuevo resumen de condición de pintura
    public function createSummary($painting_id, $condition_note_id)
    {
        $query = "INSERT INTO " . $this->table . " (painting_id, condition_note_id) VALUES (:painting_id, :condition_note_id)";
        $stmt  = $this->conn->prepare($query);
        $stmt->bindParam(':painting_id', $painting_id);
        $stmt->bindParam(':condition_note_id', $condition_note_id);
        $stmt->execute();
    }
}
