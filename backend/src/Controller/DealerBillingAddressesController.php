<?php

require_once '../src/Models/DealerBillingAddresses.php';

class DealerBillingAddressesController
{

    private $dealerBillingAddressesModel;

    public function __construct($db)
    {
        $this->dealerBillingAddressesModel = new DealerBillingAddresses($db);
    }

    // Obtener todas las direcciones de facturación de los distribuidores
    public function getDealerBillingAddresses()
    {
        $addresses = $this->dealerBillingAddressesModel->getAllBillingAddresses();
        echo json_encode($addresses);
    }

    // Crear una nueva dirección de facturación de distribuidor
    public function createDealerBillingAddress()
    {
        $data = json_decode(file_get_contents("php://input"));
        if (isset($data->dealer_id, $data->address)) {
            $this->dealerBillingAddressesModel->createBillingAddress($data->dealer_id, $data->address);
            echo json_encode(["message" => "Dirección de facturación de distribuidor creada exitosamente"]);
        } else {
            echo json_encode(["message" => "Faltan datos"]);
        }
    }
}
