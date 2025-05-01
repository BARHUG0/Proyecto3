<?php

require_once '../src/Models/PaintingLiterature.php';

class PaintingLiteratureController
{

    private $paintingLiteratureModel;

    public function __construct($db)
    {
        $this->paintingLiteratureModel = new PaintingLiterature($db);
    }

    // Obtener toda la literatura de la pintura
    public function getPaintingLiterature()
    {
        $literature = $this->paintingLiteratureModel->getAllLiterature();
        echo json_encode($literature);
    }

    // Crear una nueva entrada de literatura para una pintura
    public function createPaintingLiterature()
    {
        $data = json_decode(file_get_contents("php://input"));
        if (isset($data->painting_id, $data->publisher_country, $data->author, $data->title, $data->publication_date)) {
            $this->paintingLiteratureModel->createLiterature($data->painting_id, $data->publisher_country, $data->author, $data->title, $data->publication_date, $data->publisher, $data->page_number, $data->illustration_details);
            echo json_encode(["message" => "Literatura sobre pintura creada exitosamente"]);
        } else {
            echo json_encode(["message" => "Faltan datos"]);
        }
    }
}
