<?php

class ConditionNotes
{
    private $conn;
    private $table = 'condition_notes';

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Obtener todas las notas de condición
    public function getAllNotes()
    {
        $query = "SELECT * FROM " . $this->table;
        $stmt  = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Crear una nueva nota de condición
    public function createNote($note)
    {
        $query = "INSERT INTO " . $this->table . " (note) VALUES (:note)";
        $stmt  = $this->conn->prepare($query);
        $stmt->bindParam(':note', $note);
        $stmt->execute();
    }
}
