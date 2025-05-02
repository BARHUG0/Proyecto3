<?php

require_once '../src/Models/MovementStyle.php';

class MovementStyleController
{

    private $movementStyleModel;

    public function __construct($db)
    {
        $this->movementStyleModel = new MovementStyle($db);
    }

    // Obtener todos los estilos de movimiento
    public function getMovementStyles()
    {
        $styles = $this->movementStyleModel->getAllStyles();
        echo json_encode($styles);
    }

    // Crear un nuevo estilo de movimiento
    public function createMovementStyle()
    {
        $data = json_decode(file_get_contents("php://input"));
        if (isset($data->name, $data->description)) {
            $this->movementStyleModel->createStyle($data->name, $data->description);
            echo json_encode(["message" => "Estilo de movimiento creado exitosamente"]);
        } else {
            echo json_encode(["message" => "Faltan datos"]);
        }
    }
}
