<?php

class Surface
{
    private $conn;
    private $table = 'surface';

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Obtener todas las superficies
    public function getAllSurfaces()
    {
        $query = "SELECT * FROM " . $this->table;
        $stmt  = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Crear una nueva superficie
    public function createSurface($name, $description)
    {
        $query = "INSERT INTO " . $this->table . " (name, description) VALUES (:name, :description)";
        $stmt  = $this->conn->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->execute();
    }
}
