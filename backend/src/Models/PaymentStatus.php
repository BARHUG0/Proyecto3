<?php

class PaymentStatus
{
    private $conn;
    private $table = 'payment_status';

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Obtener todos los estados de pago
    public function getAllStatuses()
    {
        $query = "SELECT * FROM " . $this->table;
        $stmt  = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Crear un nuevo estado de pago
    public function createStatus($name)
    {
        $query = "INSERT INTO " . $this->table . " (name) VALUES (:name)";
        $stmt  = $this->conn->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->execute();
    }
}
