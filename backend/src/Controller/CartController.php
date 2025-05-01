<?php

require_once '../src/Models/Cart.php';

class CartController
{

    private $cartModel;

    public function __construct($db)
    {
        $this->cartModel = new Cart($db);
    }

    // Obtener todos los carritos
    public function getCarts()
    {
        $carts = $this->cartModel->getAllCarts();
        echo json_encode($carts);
    }

    // Crear un nuevo carrito
    public function createCart()
    {
        $data = json_decode(file_get_contents("php://input"));
        if (isset($data->buyer_id, $data->buyer_shipping_address_id, $data->buyer_billing_address_id, $data->payment_status_id, $data->subtotal, $data->tax_rate, $data->shipping_fee, $data->total, $data->payment_method)) {
            $this->cartModel->createCart($data->buyer_id, $data->buyer_shipping_address_id, $data->buyer_billing_address_id, $data->payment_status_id, $data->subtotal, $data->tax_rate, $data->shipping_fee, $data->total, $data->payment_method, $data->paid_at);
            echo json_encode(["message" => "Carrito creado exitosamente"]);
        } else {
            echo json_encode(["message" => "Faltan datos"]);
        }
    }
}
