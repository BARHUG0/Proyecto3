<?php

require_once '../src/Models/PaintingArtPeriods.php';

class PaintingArtPeriodsController
{

    private $paintingArtPeriodsModel;

    public function __construct($db)
    {
        $this->paintingArtPeriodsModel = new PaintingArtPeriods($db);
    }

    // Obtener todas las relaciones entre pintura y periodo artístico
    public function getPaintingArtPeriods()
    {
        $relations = $this->paintingArtPeriodsModel->getAllRelations();
        echo json_encode($relations);
    }

    // Crear una nueva relación entre pintura y periodo artístico
    public function createPaintingArtPeriod()
    {
        $data = json_decode(file_get_contents("php://input"));
        if (isset($data->painting_id, $data->art_period_id)) {
            $this->paintingArtPeriodsModel->createRelation($data->painting_id, $data->art_period_id);
            echo json_encode(["message" => "Relación de pintura y periodo artístico creada exitosamente"]);
        } else {
            echo json_encode(["message" => "Faltan datos"]);
        }
    }
}
