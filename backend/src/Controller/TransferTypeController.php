<?php

require_once '../src/Models/TransferType.php';

class TransferTypeController
{

    private $transferTypeModel;

    public function __construct($db)
    {
        $this->transferTypeModel = new TransferType($db);
    }

    // Obtener todos los tipos de transferencia
    public function getTransferTypes()
    {
        $types = $this->transferTypeModel->getAllTransferTypes();
        echo json_encode($types);
    }

    // Crear un nuevo tipo de transferencia
    public function createTransferType()
    {
        $data = json_decode(file_get_contents("php://input"));
        if (isset($data->name)) {
            $this->transferTypeModel->createTransferType($data->name);
            echo json_encode(["message" => "Tipo de transferencia creado exitosamente"]);
        } else {
            echo json_encode(["message" => "Faltan datos"]);
        }
    }
}
