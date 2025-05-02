<?php

require_once '../src/Models/DealerType.php';

class DealerTypeController
{

    private $dealerTypeModel;

    public function __construct($db)
    {
        $this->dealerTypeModel = new DealerType($db);
    }

    // Obtener todos los tipos de distribuidores
    public function getDealerTypes()
    {
        $dealerTypes = $this->dealerTypeModel->getAllDealerTypes();
        echo json_encode($dealerTypes);
    }

    // Crear un nuevo tipo de distribuidor
    public function createDealerType()
    {
        $data = json_decode(file_get_contents("php://input"));
        if (isset($data->name)) {
            $this->dealerTypeModel->createDealerType($data->name);
            echo json_encode(["message" => "Tipo de distribuidor creado exitosamente"]);
        } else {
            echo json_encode(["message" => "Faltan datos"]);
        }
    }
}
