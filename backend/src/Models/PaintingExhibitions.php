<?php

class PaintingExhibitions
{
    private $conn;
    private $table = 'painting_exhibitions';

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAllExhibitions()
    {
        $query = "SELECT * FROM " . $this->table;
        $stmt  = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getExhibitionById($exhibition_id)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :exhibition_id";
        $stmt  = $this->conn->prepare($query);
        $stmt->bindParam(':exhibition_id', $exhibition_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createExhibition($painting_id, $venue_location_id, $exhibition_beginning, $exhibition_ending, $exhibition_catalogue_number)
    {
        $query = "INSERT INTO " . $this->table . " (painting_id, venue_location_id, exhibition_beginning, exhibition_ending, exhibition_catalogue_number)
                  VALUES (:painting_id, :venue_location_id, :exhibition_beginning, :exhibition_ending, :exhibition_catalogue_number)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':painting_id', $painting_id);
        $stmt->bindParam(':venue_location_id', $venue_location_id);
        $stmt->bindParam(':exhibition_beginning', $exhibition_beginning);
        $stmt->bindParam(':exhibition_ending', $exhibition_ending);
        $stmt->bindParam(':exhibition_catalogue_number', $exhibition_catalogue_number);
        $stmt->execute();
    }
}
