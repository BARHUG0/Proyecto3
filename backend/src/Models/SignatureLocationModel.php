<?php

class SignatureLocation
{
    private $conn;
    private $table = 'signature_location';

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Obtener todas las ubicaciones de firma
    public function getAllLocations()
    {
        $query = "SELECT * FROM " . $this->table;
        $stmt  = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Crear una nueva ubicación de firma
    public function createLocation($name)
    {
        $query = "INSERT INTO " . $this->table . " (name) VALUES (:name)";
        $stmt  = $this->conn->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->execute();
    }
}
