<?php

require_once '../src/Models/PaymentStatus.php';

class PaymentStatusController
{

    private $paymentStatusModel;

    public function __construct($db)
    {
        $this->paymentStatusModel = new PaymentStatus($db);
    }

    // Obtener todos los estados de pago
    public function getPaymentStatuses()
    {
        $statuses = $this->paymentStatusModel->getAllStatuses();
        echo json_encode($statuses);
    }

    // Crear un nuevo estado de pago
    public function createPaymentStatus()
    {
        $data = json_decode(file_get_contents("php://input"));
        if (isset($data->name)) {
            $this->paymentStatusModel->createStatus($data->name);
            echo json_encode(["message" => "Estado de pago creado exitosamente"]);
        } else {
            echo json_encode(["message" => "Faltan datos"]);
        }
    }
}
