<?php

require_once '../src/Models/Surface.php';

class SurfaceController
{

    private $surfaceModel;

    public function __construct($db)
    {
        $this->surfaceModel = new Surface($db);
    }

    // Obtener todas las superficies
    public function getSurfaces()
    {
        $surfaces = $this->surfaceModel->getAllSurfaces();
        echo json_encode($surfaces);
    }

    // Crear una nueva superficie
    public function createSurface()
    {
        $data = json_decode(file_get_contents("php://input"));
        if (isset($data->name, $data->description)) {
            $this->surfaceModel->createSurface($data->name, $data->description);
            echo json_encode(["message" => "Superficie creada exitosamente"]);
        } else {
            echo json_encode(["message" => "Faltan datos"]);
        }
    }
}
