<?php

class VenueLocation
{
    private $conn;
    private $table = 'venue_location';

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Obtener todas las ubicaciones de los lugares
    public function getAllLocations()
    {
        $query = "SELECT * FROM " . $this->table;
        $stmt  = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Crear una nueva ubicación de lugar
    public function createLocation($venue_id, $country, $address, $phone)
    {
        $query = "INSERT INTO " . $this->table . " (venue_id, country, address, phone)
                  VALUES (:venue_id, :country, :address, :phone)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':venue_id', $venue_id);
        $stmt->bindParam(':country', $country);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':phone', $phone);
        $stmt->execute();
    }
}
