<!DOCTYPE html>
<html>
<head>
    <title>Sales Report</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>

<h1>Sales Report</h1>

<!-- File Upload Form -->
<form method="post" enctype="multipart/form-data" action="index.php">
    <input type="file" name="json_file" accept=".json" required>
    <input type="submit" value="Upload JSON">
</form>

<!-- Filter Form -->
<form method="post" action="index.php">
    Customer Name: <input type="text" name="customer_name" value="<?php echo htmlspecialchars($_POST['customer_name'] ?? '', ENT_QUOTES); ?>">
    Product Name: <input type="text" name="product_name" value="<?php echo htmlspecialchars($_POST['product_name'] ?? '', ENT_QUOTES); ?>">
    Min Price: <input type="number" name="min_price" step="0.01" value="<?php echo htmlspecialchars($_POST['min_price'] ?? '0', ENT_QUOTES); ?>">
    Max Price: <input type="number" name="max_price" step="0.01" value="<?php echo htmlspecialchars($_POST['max_price'] ?? '', ENT_QUOTES); ?>">
    <input type="submit" value="Filter">
</form>

<?php if (!empty($sales)) : ?>
    <?php
    $totalPrice = 0;
    ?>
    <table>
        <tr>
            <th>Sale ID</th>
            <th>Customer Name</th>
            <th>Customer Mail</th>
            <th>Product Name</th>
            <th>Product Price</th>
            <th>Sale Date</th>
        </tr>
        <?php foreach ($sales as $sale) : ?>
            <tr>
                <td><?php echo htmlspecialchars($sale['sale_id'], ENT_QUOTES); ?></td>
                <td><?php echo htmlspecialchars($sale['customer_name'], ENT_QUOTES); ?></td>
                <td><?php echo htmlspecialchars($sale['customer_mail'], ENT_QUOTES); ?></td>
                <td><?php echo htmlspecialchars($sale['product_name'], ENT_QUOTES); ?></td>
                <td><?php echo htmlspecialchars($sale['product_price'], ENT_QUOTES); ?></td>
                <td><?php echo htmlspecialchars($sale['sale_date'], ENT_QUOTES); ?></td>
            </tr>
            <?php $totalPrice += (float)$sale['product_price']; ?>
        <?php endforeach; ?>
        <tr>
            <td colspan="4">Total Price</td>
            <td colspan="2"><?php echo number_format($totalPrice, 2); ?></td>
        </tr>
    </table>
<?php endif; ?>

</body>
</html>
