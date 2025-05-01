<?php

class ArtPeriod
{
    private $conn;
    private $table = 'art_period';

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Obtener todos los periodos artísticos
    public function getAllPeriods()
    {
        $query = "SELECT * FROM " . $this->table;
        $stmt  = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Crear un nuevo periodo artístico
    public function createPeriod($name, $description)
    {
        $query = "INSERT INTO " . $this->table . " (name, description) VALUES (:name, :description)";
        $stmt  = $this->conn->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->execute();
    }
}
