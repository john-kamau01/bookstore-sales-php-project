<?php
// SalesController.php
require 'models/SalesModel.php';

class SalesController {
    private $model;

    public function __construct($model) {
        $this->model = $model;
    }

    public function handleRequest() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_FILES['json_file']) && $_FILES['json_file']['error'] === UPLOAD_ERR_OK) {
                $this->handleFileUpload();
            } else {
                $filters = [
                    'customer_name' => $_POST['customer_name'] ?? '',
                    'product_name' => $_POST['product_name'] ?? '',
                    'min_price' => $_POST['min_price'] ?? 0,
                    'max_price' => $_POST['max_price'] ?? PHP_INT_MAX,
                ];
                $sales = $this->model->getSales($filters);
                include 'views/salesView.php';
            }
        } else {
            $sales = [];
            include 'views/salesView.php';
        }
    }

    private function handleFileUpload() {
        $fileTmpPath = $_FILES['json_file']['tmp_name'];
        $jsonData = file_get_contents($fileTmpPath);
        $data = json_decode($jsonData, true);

        if (json_last_error() === JSON_ERROR_NONE) {
            $this->model->insertSales($data);
        } else {
            echo "Error reading JSON data.";
        }
        header("Location: index.php"); // Redirect to avoid form resubmission
        exit;
    }
}
?>
