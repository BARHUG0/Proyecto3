<?php

class Persona
{
    private $conn;
    private $table = 'persona';

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Obtener todas las personas
    public function getAllPersons()
    {
        $query = "SELECT * FROM " . $this->table;
        $stmt  = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Crear una nueva persona
    public function createPerson($nationality, $first_given_name, $second_given_name, $third_given_name, $paternal_last_name, $maternal_last_name, $birthdate)
    {
        $query = "INSERT INTO " . $this->table . " (nationality, first_given_name, second_given_name, third_given_name, paternal_last_name, maternal_last_name, birthdate)
                  VALUES (:nationality, :first_given_name, :second_given_name, :third_given_name, :paternal_last_name, :maternal_last_name, :birthdate)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nationality', $nationality);
        $stmt->bindParam(':first_given_name', $first_given_name);
        $stmt->bindParam(':second_given_name', $second_given_name);
        $stmt->bindParam(':third_given_name', $third_given_name);
        $stmt->bindParam(':paternal_last_name', $paternal_last_name);
        $stmt->bindParam(':maternal_last_name', $maternal_last_name);
        $stmt->bindParam(':birthdate', $birthdate);
        $stmt->execute();
    }
}
