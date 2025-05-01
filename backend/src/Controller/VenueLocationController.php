<?php

require_once '../src/Models/VenueLocation.php';

class VenueLocationController
{

    private $venueLocationModel;

    public function __construct($db)
    {
        $this->venueLocationModel = new VenueLocation($db);
    }

    // Obtener todas las ubicaciones de los lugares
    public function getVenueLocations()
    {
        $locations = $this->venueLocationModel->getAllLocations();
        echo json_encode($locations);
    }

    // Crear una nueva ubicación de lugar
    public function createVenueLocation()
    {
        $data = json_decode(file_get_contents("php://input"));
        if (isset($data->venue_id, $data->country, $data->address, $data->phone)) {
            $this->venueLocationModel->createLocation($data->venue_id, $data->country, $data->address, $data->phone);
            echo json_encode(["message" => "Ubicación de lugar creada exitosamente"]);
        } else {
            echo json_encode(["message" => "Faltan datos"]);
        }
    }
}
