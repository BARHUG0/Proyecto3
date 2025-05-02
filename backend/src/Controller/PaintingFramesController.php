<?php

require_once '../src/Models/PaintingFrames.php';

class PaintingFramesController
{

    private $paintingFramesModel;

    public function __construct($db)
    {
        $this->paintingFramesModel = new PaintingFrames($db);
    }

    // Obtener todos los marcos de las pinturas
    public function getPaintingFrames()
    {
        $frames = $this->paintingFramesModel->getAllFrames();
        echo json_encode($frames);
    }

    // Crear un nuevo marco para una pintura
    public function createPaintingFrame()
    {
        $data = json_decode(file_get_contents("php://input"));
        if (isset($data->painting_id, $data->width, $data->height, $data->depth, $data->full_condition_report)) {
            $this->paintingFramesModel->createFrame($data->painting_id, $data->width, $data->height, $data->depth, $data->full_condition_report);
            echo json_encode(["message" => "Marco de pintura creado exitosamente"]);
        } else {
            echo json_encode(["message" => "Faltan datos"]);
        }
    }
}
