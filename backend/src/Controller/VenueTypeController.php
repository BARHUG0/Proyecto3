<?php

require_once '../src/Models/VenueType.php';

class VenueTypeController
{

    private $venueTypeModel;

    public function __construct($db)
    {
        $this->venueTypeModel = new VenueType($db);
    }

    // Obtener todos los tipos de lugar
    public function getVenueTypes()
    {
        $types = $this->venueTypeModel->getAllTypes();
        echo json_encode($types);
    }

    // Crear un nuevo tipo de lugar
    public function createVenueType()
    {
        $data = json_decode(file_get_contents("php://input"));
        if (isset($data->type)) {
            $this->venueTypeModel->createType($data->type);
            echo json_encode(["message" => "Tipo de lugar creado exitosamente"]);
        } else {
            echo json_encode(["message" => "Faltan datos"]);
        }
    }
}
