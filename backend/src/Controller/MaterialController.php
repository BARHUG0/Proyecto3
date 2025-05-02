<?php

require_once '../src/Models/Material.php';

class MaterialController
{

    private $materialModel;

    public function __construct($db)
    {
        $this->materialModel = new Material($db);
    }

    // Obtener todos los materiales
    public function getMaterials()
    {
        $materials = $this->materialModel->getAllMaterials();
        echo json_encode($materials);
    }

    // Crear un nuevo material
    public function createMaterial()
    {
        $data = json_decode(file_get_contents("php://input"));
        if (isset($data->name, $data->description)) {
            $this->materialModel->createMaterial($data->name, $data->description);
            echo json_encode(["message" => "Material creado exitosamente"]);
        } else {
            echo json_encode(["message" => "Faltan datos"]);
        }
    }
}
