<?php

class DealerType
{
    private $conn;
    private $table = 'dealer_type';

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Obtener todos los tipos de distribuidores
    public function getAllDealerTypes()
    {
        $query = "SELECT * FROM " . $this->table;
        $stmt  = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Crear un nuevo tipo de distribuidor
    public function createDealerType($name)
    {
        $query = "INSERT INTO " . $this->table . " (name) VALUES (:name)";
        $stmt  = $this->conn->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->execute();
    }
}
