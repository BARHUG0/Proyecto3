<?php

require_once '../src/Models/Painting.php';

class PaintingController
{

    private $paintingModel;

    public function __construct($db)
    {
        $this->paintingModel = new Painting($db);
    }

    // Obtener todas las pinturas
    public function getPaintings()
    {
        $paintings = $this->paintingModel->getAllPaintings();
        echo json_encode($paintings);
    }

    // Crear una nueva pintura
    public function createPainting()
    {
        $data = json_decode(file_get_contents("php://input"));
        if (isset($data->artist_id, $data->signature_location_id, $data->width, $data->height, $data->title, $data->execution_date, $data->description)) {
            $this->paintingModel->createPainting($data->artist_id, $data->signature_location_id, $data->width, $data->height, $data->depth, $data->title, $data->execution_date, $data->description, $data->includes_authenticity_certificate, $data->full_condition_report);
            echo json_encode(["message" => "Pintura creada exitosamente"]);
        } else {
            echo json_encode(["message" => "Faltan datos"]);
        }
    }
}
