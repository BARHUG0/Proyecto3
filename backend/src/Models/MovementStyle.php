<?php

class MovementStyle
{
    private $conn;
    private $table = 'movement_style';

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Obtener todos los estilos de movimiento
    public function getAllStyles()
    {
        $query = "SELECT * FROM " . $this->table;
        $stmt  = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Crear un nuevo estilo de movimiento
    public function createStyle($name, $description)
    {
        $query = "INSERT INTO " . $this->table . " (name, description) VALUES (:name, :description)";
        $stmt  = $this->conn->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->execute();
    }
}
