<?php

class PaintingFrames
{
    private $conn;
    private $table = 'painting_frames';

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Obtener todos los marcos de las pinturas
    public function getAllFrames()
    {
        $query = "SELECT * FROM " . $this->table;
        $stmt  = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Crear un nuevo marco de pintura
    public function createFrame($painting_id, $width, $height, $depth, $full_condition_report)
    {
        $query = "INSERT INTO " . $this->table . " (painting_id, width, height, depth, full_condition_report)
                  VALUES (:painting_id, :width, :height, :depth, :full_condition_report)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':painting_id', $painting_id);
        $stmt->bindParam(':width', $width);
        $stmt->bindParam(':height', $height);
        $stmt->bindParam(':depth', $depth);
        $stmt->bindParam(':full_condition_report', $full_condition_report);
        $stmt->execute();
    }
}
