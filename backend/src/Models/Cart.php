<?php

class Cart
{
    private $conn;
    private $table = 'cart';

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Obtener todos los carritos
    public function getAllCarts()
    {
        $query = "SELECT * FROM " . $this->table;
        $stmt  = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Crear un nuevo carrito
    public function createCart($buyer_id, $buyer_shipping_address_id, $buyer_billing_address_id, $payment_status_id, $subtotal, $tax_rate, $shipping_fee, $total, $payment_method, $paid_at)
    {
        $query = "INSERT INTO " . $this->table . " (buyer_id, buyer_shipping_address_id, buyer_billing_address_id, payment_status_id, subtotal, tax_rate, shipping_fee, total, payment_method, paid_at)
                  VALUES (:buyer_id, :buyer_shipping_address_id, :buyer_billing_address_id, :payment_status_id, :subtotal, :tax_rate, :shipping_fee, :total, :payment_method, :paid_at)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':buyer_id', $buyer_id);
        $stmt->bindParam(':buyer_shipping_address_id', $buyer_shipping_address_id);
        $stmt->bindParam(':buyer_billing_address_id', $buyer_billing_address_id);
        $stmt->bindParam(':payment_status_id', $payment_status_id);
        $stmt->bindParam(':subtotal', $subtotal);
        $stmt->bindParam(':tax_rate', $tax_rate);
        $stmt->bindParam(':shipping_fee', $shipping_fee);
        $stmt->bindParam(':total', $total);
        $stmt->bindParam(':payment_method', $payment_method);
        $stmt->bindParam(':paid_at', $paid_at);
        $stmt->execute();
    }
}
