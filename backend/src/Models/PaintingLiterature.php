<?php

class PaintingLiterature
{
    private $conn;
    private $table = 'painting_literature';

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Obtener toda la literatura relacionada con la pintura
    public function getAllLiterature()
    {
        $query = "SELECT * FROM " . $this->table;
        $stmt  = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Crear una nueva entrada de literatura para una pintura
    public function createLiterature($painting_id, $publisher_country, $author, $title, $publication_date, $publisher, $page_number, $illustration_details)
    {
        $query = "INSERT INTO " . $this->table . " (painting_id, publisher_country, author, title, publication_date, publisher, page_number, illustration_details)
                  VALUES (:painting_id, :publisher_country, :author, :title, :publication_date, :publisher, :page_number, :illustration_details)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':painting_id', $painting_id);
        $stmt->bindParam(':publisher_country', $publisher_country);
        $stmt->bindParam(':author', $author);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':publication_date', $publication_date);
        $stmt->bindParam(':publisher', $publisher);
        $stmt->bindParam(':page_number', $page_number);
        $stmt->bindParam(':illustration_details', $illustration_details);
        $stmt->execute();
    }
}
