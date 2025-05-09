<?php

require_once __DIR__ . '/../Models/PaintingMaterials.php';

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
    
    public function getPaintingMaterialsReport()
    {
        $rawreport = $this->paintingMaterialsModel->getMaterialsByPaintingReport();
        $report  = [];
        foreach ($rawreport as $raw) {
            $report[]  = [
                'title'   => $raw['title'],
                'name'   => $raw['name'],
            ];
        }
        echo json_encode($report);

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
