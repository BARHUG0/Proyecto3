<?php

class VenueLocation
{
    private $conn;
    private $table = 'venue_location';

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAllLocations()
    {
        $query = "SELECT * FROM " . $this->table;
        $stmt  = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

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

    public function getLocationById($venue_location_id)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :venue_location_id";
        $stmt  = $this->conn->prepare($query);
        $stmt->bindParam(':venue_location_id', $venue_location_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
