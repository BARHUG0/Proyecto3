<?php

class Dealer
{
    private $conn;
    private $table = 'dealer';

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Obtener todos los distribuidores
    public function getAllDealers()
    {
        $query = "SELECT * FROM " . $this->table;
        $stmt  = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDealerById($dealer_id)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :dealer_id";
        $stmt  = $this->conn->prepare($query);
        $stmt->bindParam(':dealer_id', $dealer_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createDealer($dealer_type_id, $dealer_entity_id)
    {
        $query = "INSERT INTO " . $this->table . " (dealer_type_id, dealer_entity_id) VALUES (:dealer_type_id, :dealer_entity_id)";
        $stmt  = $this->conn->prepare($query);
        $stmt->bindParam(':dealer_type_id', $dealer_type_id);
        $stmt->bindParam(':dealer_entity_id', $dealer_entity_id);
        $stmt->execute();
    }
}
