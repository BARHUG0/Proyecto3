<?php

class DealerBillingAddresses
{
    private $conn;
    private $table = 'dealer_billing_addresses';

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Obtener todas las direcciones de facturación de los distribuidores
    public function getAllBillingAddresses()
    {
        $query = "SELECT * FROM " . $this->table;
        $stmt  = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Crear una nueva dirección de facturación de distribuidor
    public function createBillingAddress($dealer_id, $address)
    {
        $query = "INSERT INTO " . $this->table . " (dealer_id, address) VALUES (:dealer_id, :address)";
        $stmt  = $this->conn->prepare($query);
        $stmt->bindParam(':dealer_id', $dealer_id);
        $stmt->bindParam(':address', $address);
        $stmt->execute();
    }
}
