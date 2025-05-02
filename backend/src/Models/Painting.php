<?php

class Painting
{
    private $conn;
    private $table = 'painting';

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Obtener todas las pinturas
    public function getAllPaintings()
    {
        $query = "SELECT * FROM " . $this->table;
        $stmt  = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getPaintingById($painting_id)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :painting_id";
        $stmt  = $this->conn->prepare($query);
        $stmt->bindParam(':painting_id', $painting_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createPainting($artist_id, $signature_location_id, $width, $height, $depth, $title, $execution_date, $description, $includes_authenticity_certificate, $full_condition_report)
    {
        $query = "INSERT INTO " . $this->table . " (artist_id, signature_location_id, width, height, depth, title, execution_date, description, includes_authenticity_certificate, full_condition_report)
                  VALUES (:artist_id, :signature_location_id, :width, :height, :depth, :title, :execution_date, :description, :includes_authenticity_certificate, :full_condition_report)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':artist_id', $artist_id);
        $stmt->bindParam(':signature_location_id', $signature_location_id);
        $stmt->bindParam(':width', $width);
        $stmt->bindParam(':height', $height);
        $stmt->bindParam(':depth', $depth);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':execution_date', $execution_date);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':includes_authenticity_certificate', $includes_authenticity_certificate);
        $stmt->bindParam(':full_condition_report', $full_condition_report);
        $stmt->execute();
    }
}
