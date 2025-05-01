<?php

class Venue
{
    private $conn;
    private $table = 'venue';

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Obtener todos los lugares
    public function getAllVenues()
    {
        $query = "SELECT * FROM " . $this->table;
        $stmt  = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Crear un nuevo lugar
    public function createVenue($venue_type_id, $name, $description, $website_url)
    {
        $query = "INSERT INTO " . $this->table . " (venue_type_id, name, description, website_url)
                  VALUES (:venue_type_id, :name, :description, :website_url)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':venue_type_id', $venue_type_id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':website_url', $website_url);
        $stmt->execute();
    }
}
