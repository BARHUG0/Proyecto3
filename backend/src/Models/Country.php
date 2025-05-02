<?php

class Country
{
    private $conn;
    private $table = 'country';

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Obtener todos los países
    public function getAllCountries()
    {
        $query = "SELECT * FROM " . $this->table;
        $stmt  = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Crear un nuevo país
    public function createCountry($name)
    {
        $query = "INSERT INTO " . $this->table . " (name) VALUES (:name)";
        $stmt  = $this->conn->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->execute();
    }
}
