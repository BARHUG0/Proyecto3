<?php

class VenueType
{
    private $conn;
    private $table = 'venue_type';

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Obtener todos los tipos de lugar
    public function getAllTypes()
    {
        $query = "SELECT * FROM " . $this->table;
        $stmt  = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Crear un nuevo tipo de lugar
    public function createType($type)
    {
        $query = "INSERT INTO " . $this->table . " (type) VALUES (:type)";
        $stmt  = $this->conn->prepare($query);
        $stmt->bindParam(':type', $type);
        $stmt->execute();
    }
}
