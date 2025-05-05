<?php

require_once __DIR__ . '/../Models/PaintingExhibitions.php';
require_once __DIR__ . '/../Models/Painting.php';
require_once __DIR__ . '/../Models/VenueLocation.php';

class PaintingExhibitionsController
{

    private $paintingExhibitionsModel;
    private $paintingModel;
    private $venueLocationModel;

    public function __construct($db)
    {
        $this->paintingExhibitionsModel = new PaintingExhibitions($db);
        $this->paintingModel            = new Painting($db);
        $this->venueLocationModel       = new VenueLocation($db);
    }

    public function getExhibitionsReport()
    {
        $exhibitions = $this->paintingExhibitionsModel->getAllExhibitions();
        $report      = [];
        foreach ($exhibitions as $exhibition) {
            $painting      = $this->getPaintingById($exhibition['painting_id']);
            $venueLocation = $this->getVenueLocationById($exhibition['venue_location_id']);

            $report[] = [
                'painting_title'              => $painting['title'],
                'venue'                       => $venueLocation['name'],
                'exhibition_beginning'        => $exhibition['exhibition_beginning'],
                'exhibition_ending'           => $exhibition['exhibition_ending'],
                'exhibition_catalogue_number' => $exhibition['exhibition_catalogue_number'],
            ];
        }
        echo json_encode($report);
    }

    public function createExhibition()
    {
        $data = json_decode(file_get_contents("php://input"));
        if (isset($data->painting_id, $data->venue_location_id, $data->exhibition_beginning, $data->exhibition_ending, $data->exhibition_catalogue_number)) {
            $this->paintingExhibitionsModel->createExhibition($data->painting_id, $data->venue_location_id, $data->exhibition_beginning, $data->exhibition_ending, $data->exhibition_catalogue_number);
            echo json_encode(["message" => "Exposición de pintura creada exitosamente"]);
        } else {
            echo json_encode(["message" => "Faltan datos"]);
        }
    }

    private function getPaintingById($painting_id)
    {
        return $this->paintingModel->getPaintingById($painting_id);
    }

    private function getVenueLocationById($venue_location_id)
    {
        return $this->venueLocationModel->getLocationById($venue_location_id);
    }
}
