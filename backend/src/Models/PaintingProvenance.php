<?php

class PaintingProvenance
{
    private $conn;
    private $table = 'painting_provenance';

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Obtener todas las procedencias de pintura
    public function getAllProvenances()
    {
        $query = "SELECT * FROM " . $this->table;
        $stmt  = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Crear una nueva procedencia de pintura
    public function createProvenance($painting_id, $transfer_type_id, $transfer_owner, $transfer_date, $description)
    {
        $query = "INSERT INTO " . $this->table . " (painting_id, transfer_type_id, transfer_owner, transfer_date, description)
                  VALUES (:painting_id, :transfer_type_id, :transfer_owner, :transfer_date, :description)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':painting_id', $painting_id);
        $stmt->bindParam(':transfer_type_id', $transfer_type_id);
        $stmt->bindParam(':transfer_owner', $transfer_owner);
        $stmt->bindParam(':transfer_date', $transfer_date);
        $stmt->bindParam(':description', $description);
        $stmt->execute();
    }
}
