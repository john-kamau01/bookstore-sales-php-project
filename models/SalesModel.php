<?php
// SalesModel.php
require 'config/config.php';

class SalesModel {
    private $mysqli;

    public function __construct($mysqli) {
        $this->mysqli = $mysqli;
    }

    public function insertSales($data) {
        $stmt = $this->mysqli->prepare("INSERT INTO sales (sale_id, customer_name, customer_mail, product_name, product_price, sale_date) VALUES (?, ?, ?, ?, ?, ?)");
        foreach ($data as $sale) {
            // Convert product_price to float
            $productPrice = (float)$sale['product_price'];
            // Bind parameters
            $stmt->bind_param("issdss", $sale['sale_id'], $sale['customer_name'], $sale['customer_mail'], $productPrice, $sale['product_name'], $sale['sale_date']);
            // Execute the statement
            $stmt->execute();
        }
        $stmt->close();
    }

    
}
?>
