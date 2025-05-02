<?php

require_once '../src/Models/SignatureLocation.php';

class SignatureLocationController
{

    private $signatureLocationModel;

    public function __construct($db)
    {
        $this->signatureLocationModel = new SignatureLocation($db);
    }

    // Obtener todas las ubicaciones de firma
    public function getLocations()
    {
        $locations = $this->signatureLocationModel->getAllLocations();
        echo json_encode($locations);
    }

    // Crear una nueva ubicación de firma
    public function createLocation()
    {
        $data = json_decode(file_get_contents("php://input"));
        if (isset($data->name)) {
            $this->signatureLocationModel->createLocation($data->name);
            echo json_encode(["message" => "Ubicación de firma creada exitosamente"]);
        } else {
            echo json_encode(["message" => "Faltan datos"]);
        }
    }
}
