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

    public function getAllPaintingProvenances()
    {
        $query = "SELECT p.title, t.name, pp.transfer_owner, pp.transfer_date, pp.description  FROM painting_provenance AS pp JOIN painting AS p ON p.id = pp.painting_id JOIN transfer_type AS t ON t.id = pp.transfer_type_id";
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
