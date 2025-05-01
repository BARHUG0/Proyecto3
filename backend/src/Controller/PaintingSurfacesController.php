<?php

require_once '../src/Models/PaintingSurfaces.php';

class PaintingSurfacesController
{

    private $paintingSurfacesModel;

    public function __construct($db)
    {
        $this->paintingSurfacesModel = new PaintingSurfaces($db);
    }

    // Obtener todas las relaciones entre pintura y superficie
    public function getPaintingSurfaces()
    {
        $relations = $this->paintingSurfacesModel->getAllRelations();
        echo json_encode($relations);
    }

    // Crear una nueva relación entre pintura y superficie
    public function createPaintingSurface()
    {
        $data = json_decode(file_get_contents("php://input"));
        if (isset($data->painting_id, $data->surface_id)) {
            $this->paintingSurfacesModel->createRelation($data->painting_id, $data->surface_id);
            echo json_encode(["message" => "Relación de pintura y superficie creada exitosamente"]);
        } else {
            echo json_encode(["message" => "Faltan datos"]);
        }
    }
}
