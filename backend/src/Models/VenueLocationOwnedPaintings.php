<?php

class VenueLocationOwnedPaintings
{
    private $conn;
    private $table = 'venue_location_owned_paintings';

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Obtener todas las pinturas propiedad de una ubicación de lugar
    public function getAllOwnedPaintings()
    {
        $query = "SELECT * FROM " . $this->table;
        $stmt  = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Crear una nueva pintura propiedad de una ubicación de lugar
    public function createOwnedPainting($painting_id, $venue_location_id, $beginning_of_ownership, $ending_of_ownership)
    {
        $query = "INSERT INTO " . $this->table . " (painting_id, venue_location_id, beginning_of_ownership, ending_of_ownership)
                  VALUES (:painting_id, :venue_location_id, :beginning_of_ownership, :ending_of_ownership)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':painting_id', $painting_id);
        $stmt->bindParam(':venue_location_id', $venue_location_id);
        $stmt->bindParam(':beginning_of_ownership', $beginning_of_ownership);
        $stmt->bindParam(':ending_of_ownership', $ending_of_ownership);
        $stmt->execute();
    }
}
