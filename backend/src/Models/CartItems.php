<?php

class CartItems
{
    private $conn;
    private $table = 'cart_items';

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Obtener todos los artículos del carrito
    public function getAllCartItems()
    {
        $query = "SELECT * FROM " . $this->table;
        $stmt  = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Crear un nuevo artículo en el carrito
    public function createCartItem($cart_id, $sale_id)
    {
        $query = "INSERT INTO " . $this->table . " (cart_id, sale_id) VALUES (:cart_id, :sale_id)";
        $stmt  = $this->conn->prepare($query);
        $stmt->bindParam(':cart_id', $cart_id);
        $stmt->bindParam(':sale_id', $sale_id);
        $stmt->execute();
    }
}
