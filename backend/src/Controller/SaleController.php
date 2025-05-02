<?php

require_once __DIR__ . '/../Models/Sale.php';
require_once __DIR__ . '/../Models/Painting.php';
require_once __DIR__ . '/../Models/Dealer.php';

class SaleController
{

    private $saleModel;
    private $paintingModel;
    private $dealerModel;

    public function __construct($db)
    {
        $this->saleModel     = new Sale($db);
        $this->paintingModel = new Painting($db);
        $this->dealerModel   = new Dealer($db);
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

    public function getSalesReport()
    {
        $sales = $this->saleModel->getAllSales();

        $report = [];

        foreach ($sales as $sale) {
            $painting = $this->getPaintingById($sale['painting_id']);
            $dealer   = $this->getDealerById($sale['seller_id']);

            $report[] = [
                'painting_title' => $painting['title'],
                'seller'         => $dealer['name'],
                'sold_price'     => $sale['sold_price'],
                'sold_date'      => $sale['sold_date'],
                'beginning_date' => $sale['beginning_date'],
                'ending_date'    => $sale['ending_date'],
            ];
        }
        echo json_encode($report);
    }
    private function getPaintingById($painting_id)
    {
        return $this->paintingModel->getPaintingById($painting_id);
    }

    private function getDealerById($dealer_id)
    {
        return $this->dealerModel->getDealerById($dealer_id);
    }
}
