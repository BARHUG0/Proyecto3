<?php

class Artist
{
    private $conn;
    private $table = 'artist';
    private $personaTable = 'persona';
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Obtener todos los artistas
    public function getAllArtists()
    {
        // Join con la tabla persona para obtener los nombres completos del artista
        $query = "SELECT a.id, p.first_given_name, p.second_given_name, p.paternal_last_name, p.maternal_last_name, 
                         a.pseudonym, a.description, a.created_at, a.updated_at
                  FROM " . $this->table . " a
                  LEFT JOIN " . $this->personaTable . " p ON a.persona_id = p.id";
        $stmt = $this->conn->prepare($query);
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
        public function getArtistNameById($artist_id)
    {
        $query = "SELECT a.id, p.first_given_name, p.second_given_name, p.paternal_last_name, p.maternal_last_name, 
                         a.pseudonym, a.description, a.created_at, a.updated_at
                  FROM " . $this->table . " a
                  LEFT JOIN " . $this->personaTable . " p ON a.persona_id = p.id
                  WHERE a.id = :artist_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':artist_id', $artist_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

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
