<?php

class TransferType
{
    private $conn;
    private $table = 'transfer_type';

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Obtener todos los tipos de transferencia
    public function getAllTransferTypes()
    {
        $query = "SELECT * FROM " . $this->table;
        $stmt  = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Crear un nuevo tipo de transferencia
    public function createTransferType($name)
    {
        $query = "INSERT INTO " . $this->table . " (name) VALUES (:name)";
        $stmt  = $this->conn->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->execute();
    }
}
