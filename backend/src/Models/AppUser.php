<?php

class AppUser
{
    private $conn;
    private $table = 'app_user';

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Obtener todos los usuarios de la aplicación
    public function getAllAppUsers()
    {
        $query = "SELECT * FROM " . $this->table;
        $stmt  = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Crear un nuevo usuario de la aplicación
    public function createAppUser($persona_id, $residence_country, $residence_address, $government_issued_id, $email_address, $phone_number)
    {
        $query = "INSERT INTO " . $this->table . " (persona_id, residence_country, residence_address, government_issued_id, email_address, phone_number)
                  VALUES (:persona_id, :residence_country, :residence_address, :government_issued_id, :email_address, :phone_number)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':persona_id', $persona_id);
        $stmt->bindParam(':residence_country', $residence_country);
        $stmt->bindParam(':residence_address', $residence_address);
        $stmt->bindParam(':government_issued_id', $government_issued_id);
        $stmt->bindParam(':email_address', $email_address);
        $stmt->bindParam(':phone_number', $phone_number);
        $stmt->execute();
    }
}
