<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Replace with your actual database connection parameters
        $db_server = "your_server";
        $db_name = "your_database";
        $db_username = "your_username";
        $db_password = "your_password";

        // Create a PDO database connection
        $pdo = new PDO("mysql:host=$db_server;dbname=$db_name", $db_username, $db_password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Loop through the product data and update the database
        foreach ($_POST as $productId => $productData) {
            $productStatus = $productData['product_status'];
            $productName = $productData['product_name'];
            $productSupplier = $productData['product_supplier'];

            // Prepare and execute an SQL query to update the status and other columns
            $stmt = $pdo->prepare("UPDATE products SET product_status = :status, product_name = :name, product_supplier = :supplier WHERE product_id = :id");
            $stmt->bindParam(':status', $productStatus, PDO::PARAM_STR);
            $stmt->bindParam(':name', $productName, PDO::PARAM_STR);
            $stmt->bindParam(':supplier', $productSupplier, PDO::PARAM_STR);
            $stmt->bindParam(':id', $productId, PDO::PARAM_INT);
            $stmt->execute();
        }

        echo "Product data updated successfully.";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    } finally {
        $pdo = null; // Close the database connection
    }
} else {
    echo "Invalid request.";
}
?>