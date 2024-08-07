<?php
// SalesModel.php
require 'config/config.php';

class SalesModel {
    private $mysqli;

    public function __construct($mysqli) {
        $this->mysqli = $mysqli;
    }

    public function insertSales($data) {
        // Prepare SQL statement to check if sale_id exists
        $checkStmt = $this->mysqli->prepare("SELECT COUNT(*) FROM sales WHERE sale_id = ?");
        // Prepare SQL statement to insert new record
        $insertStmt = $this->mysqli->prepare("INSERT INTO sales (sale_id, customer_name, customer_mail, product_id, product_name, product_price, sale_date) VALUES (?, ?, ?, ?, ?, ?, ?)");

        foreach ($data as $sale) {
            // Initialize $count
            $count = 0;
            // Check if sale_id already exists
            $checkStmt->bind_param("i", $sale['sale_id']);
            $checkStmt->execute();
            $checkStmt->bind_result($count);
            $checkStmt->fetch();
            if ($count > 0) {
                // Skip insertion if sale_id exists
                echo "Sale ID {$sale['sale_id']} already exists. Skipping...\n";
                continue;
            }

            // Convert product_price to float
            $productPrice = (float)$sale['product_price'];
            // Bind parameters and execute insert statement
            $insertStmt->bind_param("issdsss", $sale['sale_id'], $sale['customer_name'], $sale['customer_mail'], $sale['product_id'], $sale['product_name'], $productPrice, $sale['sale_date']);
            $insertStmt->execute();
        }
        
        $checkStmt->close();
        $insertStmt->close();
    }

    public function getSales($filters) {
        $query = "SELECT * FROM sales WHERE customer_name LIKE ? AND product_name LIKE ? AND product_price BETWEEN ? AND ?";
        $stmt = $this->mysqli->prepare($query);

        $customerName = "%{$filters['customer_name']}%";
        $productName = "%{$filters['product_name']}%";
        $minPrice = $filters['min_price'] ?: 0;
        $maxPrice = $filters['max_price'] ?: PHP_INT_MAX;

        $stmt->bind_param("ssdd", $customerName, $productName, $minPrice, $maxPrice);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>
