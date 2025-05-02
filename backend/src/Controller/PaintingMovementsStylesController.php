<?php

require_once '../src/Models/PaintingMovementsStyles.php';

class PaintingMovementsStylesController
{

    private $paintingMovementsStylesModel;

    public function __construct($db)
    {
        $this->paintingMovementsStylesModel = new PaintingMovementsStyles($db);
    }

    // Obtener todas las relaciones entre pintura y estilo de movimiento
    public function getPaintingMovementStyles()
    {
        $relations = $this->paintingMovementsStylesModel->getAllRelations();
        echo json_encode($relations);
    }

    // Crear una nueva relación entre pintura y estilo de movimiento
    public function createPaintingMovementStyle()
    {
        $data = json_decode(file_get_contents("php://input"));
        if (isset($data->painting_id, $data->movement_style_id)) {
            $this->paintingMovementsStylesModel->createRelation($data->painting_id, $data->movement_style_id);
            echo json_encode(["message" => "Relación entre pintura y estilo de movimiento creada exitosamente"]);
        } else {
            echo json_encode(["message" => "Faltan datos"]);
        }
    }
}
