<?php

require_once '../src/Models/PaintingExhibitions.php';

class PaintingExhibitionsController
{

    private $paintingExhibitionsModel;

    public function __construct($db)
    {
        $this->paintingExhibitionsModel = new PaintingExhibitions($db);
    }

    // Obtener todas las exposiciones de pintura
    public function getExhibitions()
    {
        $exhibitions = $this->paintingExhibitionsModel->getAllExhibitions();
        echo json_encode($exhibitions);
    }

    // Crear una nueva exposición de pintura
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
}
