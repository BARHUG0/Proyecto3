<?php

class Sale
{
    private $conn;
    private $table = 'sale';

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Obtener todas las ventas
    public function getAllSales()
    {
        $query = "SELECT * FROM " . $this->table;
        $stmt  = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getSaleById($sale_id)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :sale_id";
        $stmt  = $this->conn->prepare($query);
        $stmt->bindParam(':sale_id', $sale_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Crear una nueva venta
    public function createSale($painting_id, $seller_id, $beginning_date, $ending_date, $sold_date, $lowest_estimated_price, $highest_estimated_price, $base_price, $sold_price, $is_available)
    {
        $query = "INSERT INTO " . $this->table . " (painting_id, seller_id, beginning_date, ending_date, sold_date, lowest_estimated_price, highest_estimated_price, base_price, sold_price, is_available)
                  VALUES (:painting_id, :seller_id, :beginning_date, :ending_date, :sold_date, :lowest_estimated_price, :highest_estimated_price, :base_price, :sold_price, :is_available)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':painting_id', $painting_id);
        $stmt->bindParam(':seller_id', $seller_id);
        $stmt->bindParam(':beginning_date', $beginning_date);
        $stmt->bindParam(':ending_date', $ending_date);
        $stmt->bindParam(':sold_date', $sold_date);
        $stmt->bindParam(':lowest_estimated_price', $lowest_estimated_price);
        $stmt->bindParam(':highest_estimated_price', $highest_estimated_price);
        $stmt->bindParam(':base_price', $base_price);
        $stmt->bindParam(':sold_price', $sold_price);
        $stmt->bindParam(':is_available', $is_available);
        $stmt->execute();
    }
}
