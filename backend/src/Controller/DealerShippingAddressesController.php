<?php

require_once '../src/Models/DealerShippingAddresses.php';

class DealerShippingAddressesController
{

    private $dealerShippingAddressesModel;

    public function __construct($db)
    {
        $this->dealerShippingAddressesModel = new DealerShippingAddresses($db);
    }

    // Obtener todas las direcciones de envío de los distribuidores
    public function getDealerShippingAddresses()
    {
        $addresses = $this->dealerShippingAddressesModel->getAllShippingAddresses();
        echo json_encode($addresses);
    }

    // Crear una nueva dirección de envío de distribuidor
    public function createDealerShippingAddress()
    {
        $data = json_decode(file_get_contents("php://input"));
        if (isset($data->dealer_id, $data->address)) {
            $this->dealerShippingAddressesModel->createShippingAddress($data->dealer_id, $data->address);
            echo json_encode(["message" => "Dirección de envío de distribuidor creada exitosamente"]);
        } else {
            echo json_encode(["message" => "Faltan datos"]);
        }
    }
}
