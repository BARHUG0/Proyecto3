<?php

require_once '../src/Models/Dealer.php';

class DealerController
{

    private $dealerModel;

    public function __construct($db)
    {
        $this->dealerModel = new Dealer($db);
    }

    // Obtener todos los distribuidores
    public function getDealers()
    {
        $dealers = $this->dealerModel->getAllDealers();
        echo json_encode($dealers);
    }

    // Crear un nuevo distribuidor
    public function createDealer()
    {
        $data = json_decode(file_get_contents("php://input"));
        if (isset($data->dealer_type_id, $data->dealer_entity_id)) {
            $this->dealerModel->createDealer($data->dealer_type_id, $data->dealer_entity_id);
            echo json_encode(["message" => "Distribuidor creado exitosamente"]);
        } else {
            echo json_encode(["message" => "Faltan datos"]);
        }
    }
}
