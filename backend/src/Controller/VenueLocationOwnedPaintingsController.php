<?php

require_once '../src/Models/VenueLocationOwnedPaintings.php';

class VenueLocationOwnedPaintingsController
{

    private $venueLocationOwnedPaintingsModel;

    public function __construct($db)
    {
        $this->venueLocationOwnedPaintingsModel = new VenueLocationOwnedPaintings($db);
    }

    // Obtener todas las pinturas propiedad de una ubicación de lugar
    public function getOwnedPaintings()
    {
        $ownedPaintings = $this->venueLocationOwnedPaintingsModel->getAllOwnedPaintings();
        echo json_encode($ownedPaintings);
    }

    // Crear una nueva pintura propiedad de una ubicación de lugar
    public function createOwnedPainting()
    {
        $data = json_decode(file_get_contents("php://input"));
        if (isset($data->painting_id, $data->venue_location_id, $data->beginning_of_ownership, $data->ending_of_ownership)) {
            $this->venueLocationOwnedPaintingsModel->createOwnedPainting($data->painting_id, $data->venue_location_id, $data->beginning_of_ownership, $data->ending_of_ownership);
            echo json_encode(["message" => "Pintura propiedad de ubicación creada exitosamente"]);
        } else {
            echo json_encode(["message" => "Faltan datos"]);
        }
    }
}
