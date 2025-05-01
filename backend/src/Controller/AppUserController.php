<?php

require_once '../src/Models/AppUser.php';

class AppUserController
{

    private $appUserModel;

    public function __construct($db)
    {
        $this->appUserModel = new AppUser($db);
    }

    // Obtener todos los usuarios de la aplicación
    public function getAppUsers()
    {
        $appUsers = $this->appUserModel->getAllAppUsers();
        echo json_encode($appUsers);
    }

    // Crear un nuevo usuario de la aplicación
    public function createAppUser()
    {
        $data = json_decode(file_get_contents("php://input"));
        if (isset($data->persona_id, $data->residence_country, $data->residence_address, $data->government_issued_id, $data->email_address, $data->phone_number)) {
            $this->appUserModel->createAppUser($data->persona_id, $data->residence_country, $data->residence_address, $data->government_issued_id, $data->email_address, $data->phone_number);
            echo json_encode(["message" => "Usuario de la aplicación creado exitosamente"]);
        } else {
            echo json_encode(["message" => "Faltan datos"]);
        }
    }
}
