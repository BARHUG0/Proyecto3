<?php

require_once '../src/Models/PaintingMaterials.php';

class PaintingMaterialsController
{

    private $paintingMaterialsModel;

    public function __construct($db)
    {
        $this->paintingMaterialsModel = new PaintingMaterials($db);
    }

    // Obtener todas las relaciones entre pintura y material
    public function getPaintingMaterials()
    {
        $relations = $this->paintingMaterialsModel->getAllRelations();
        echo json_encode($relations);
    }

    // Crear una nueva relación entre pintura y material
    public function createPaintingMaterial()
    {
        $data = json_decode(file_get_contents("php://input"));
        if (isset($data->painting_id, $data->material_id)) {
            $this->paintingMaterialsModel->createRelation($data->painting_id, $data->material_id);
            echo json_encode(["message" => "Relación de pintura y material creada exitosamente"]);
        } else {
            echo json_encode(["message" => "Faltan datos"]);
        }
    }
}
