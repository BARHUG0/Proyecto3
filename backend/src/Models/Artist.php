<?php

class Artist
{
    private $conn;
    private $table = 'artist';

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Obtener todos los artistas
    public function getAllArtists()
    {
        $query = "SELECT * FROM " . $this->table;
        $stmt  = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getArtistById($artist_id)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :artist_id";
        $stmt  = $this->conn->prepare($query);
        $stmt->bindParam(':artist_id', $artist_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Crear un nuevo artista
    public function createArtist($persona_id, $pseudonym, $description)
    {
        $query = "INSERT INTO " . $this->table . " (persona_id, pseudonym, description) VALUES (:persona_id, :pseudonym, :description)";
        $stmt  = $this->conn->prepare($query);
        $stmt->bindParam(':persona_id', $persona_id);
        $stmt->bindParam(':pseudonym', $pseudonym);
        $stmt->bindParam(':description', $description);
        $stmt->execute();
    }
}
