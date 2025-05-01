<?php

require_once '../src/Models/Venue.php';

class VenueController
{

    private $venueModel;

    public function __construct($db)
    {
        $this->venueModel = new Venue($db);
    }

    // Obtener todos los lugares
    public function getVenues()
    {
        $venues = $this->venueModel->getAllVenues();
        echo json_encode($venues);
    }

    // Crear un nuevo lugar
    public function createVenue()
    {
        $data = json_decode(file_get_contents("php://input"));
        if (isset($data->venue_type_id, $data->name, $data->description, $data->website_url)) {
            $this->venueModel->createVenue($data->venue_type_id, $data->name, $data->description, $data->website_url);
            echo json_encode(["message" => "Lugar creado exitosamente"]);
        } else {
            echo json_encode(["message" => "Faltan datos"]);
        }
    }
}
