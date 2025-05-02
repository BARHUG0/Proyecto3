<?php

require_once '../src/Models/Sale.php';

class SaleController
{

    private $saleModel;

    public function __construct($db)
    {
        $this->saleModel = new Sale($db);
    }

    // Obtener todas las ventas
    public function getSales()
    {
        $sales = $this->saleModel->getAllSales();
        echo json_encode($sales);
    }

    // Crear una nueva venta
    public function createSale()
    {
        $data = json_decode(file_get_contents("php://input"));
        if (isset($data->painting_id, $data->seller_id, $data->beginning_date, $data->lowest_estimated_price, $data->highest_estimated_price)) {
            $this->saleModel->createSale($data->painting_id, $data->seller_id, $data->beginning_date, $data->ending_date, $data->sold_date, $data->lowest_estimated_price, $data->highest_estimated_price, $data->base_price, $data->sold_price, $data->is_available);
            echo json_encode(["message" => "Venta creada exitosamente"]);
        } else {
            echo json_encode(["message" => "Faltan datos"]);
        }
    }
}
