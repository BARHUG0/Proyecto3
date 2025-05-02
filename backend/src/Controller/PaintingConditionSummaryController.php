<?php

require_once '../src/Models/PaintingConditionSummary.php';

class PaintingConditionSummaryController
{

    private $paintingConditionSummaryModel;

    public function __construct($db)
    {
        $this->paintingConditionSummaryModel = new PaintingConditionSummary($db);
    }

    // Obtener todos los resúmenes de condición de pintura
    public function getPaintingConditionSummaries()
    {
        $summaries = $this->paintingConditionSummaryModel->getAllSummaries();
        echo json_encode($summaries);
    }

    // Crear un nuevo resumen de condición de pintura
    public function createPaintingConditionSummary()
    {
        $data = json_decode(file_get_contents("php://input"));
        if (isset($data->painting_id, $data->condition_note_id)) {
            $this->paintingConditionSummaryModel->createSummary($data->painting_id, $data->condition_note_id);
            echo json_encode(["message" => "Resumen de condición de pintura creado exitosamente"]);
        } else {
            echo json_encode(["message" => "Faltan datos"]);
        }
    }
}
