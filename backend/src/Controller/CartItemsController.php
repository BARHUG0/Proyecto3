<?php

require_once '../src/Models/CartItems.php';

class CartItemsController
{

    private $cartItemsModel;

    public function __construct($db)
    {
        $this->cartItemsModel = new CartItems($db);
    }

    // Obtener todos los artículos del carrito
    public function getCartItems()
    {
        $cartItems = $this->cartItemsModel->getAllCartItems();
        echo json_encode($cartItems);
    }

    // Crear un nuevo artículo en el carrito
    public function createCartItem()
    {
        $data = json_decode(file_get_contents("php://input"));
        if (isset($data->cart_id, $data->sale_id)) {
            $this->cartItemsModel->createCartItem($data->cart_id, $data->sale_id);
            echo json_encode(["message" => "Artículo del carrito creado exitosamente"]);
        } else {
            echo json_encode(["message" => "Faltan datos"]);
        }
    }
}
