<?php

class DealerShippingAddresses
{
    private $conn;
    private $table = 'dealer_shipping_addresses';

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Obtener todas las direcciones de envío de los distribuidores
    public function getAllShippingAddresses()
    {
        $query = "SELECT * FROM " . $this->table;
        $stmt  = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Crear una nueva dirección de envío de distribuidor
    public function createShippingAddress($dealer_id, $address)
    {
        $query = "INSERT INTO " . $this->table . " (dealer_id, address) VALUES (:dealer_id, :address)";
        $stmt  = $this->conn->prepare($query);
        $stmt->bindParam(':dealer_id', $dealer_id);
        $stmt->bindParam(':address', $address);
        $stmt->execute();
    }
}
