<?php
include('connection.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Create a PDO database connection
        $pdo = new PDO("mysql:host=localhost;dbname=inventory", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Receive the JSON data sent from JavaScript
        $productListJSON = $_POST["productList"];

        // Decode the JSON data into a PHP array
        $productList = json_decode($productListJSON, true);

        

        // Loop through the product list and update the database
        foreach ($productList as $productData) {
            $delivered = (int) $productData['qtyDelivered'];
            
            if($delivered > 0){
                $curr_qty_received = (int) $productData['qtyReceived'];
                $productId = $productData['id'];
                $qtyOrdered = (int) $productData['qtyOrdered'];
                $qtyReceived = (int) $productData['qtyReceived'];
                $status = $productData['status'];


                
                
                $updated_qty_received = $curr_qty_received + $delivered;
                $qty_remaining = $qtyOrdered - $updated_qty_received;
    
                // Prepare and execute an SQL query to update the product
                // $stmt = $pdo->prepare("UPDATE your_product_table SET qty_ordered = :qtyOrdered, qty_received = :qtyReceived, status = :status WHERE id = :id");
                $stmt = $pdo->prepare("UPDATE order_product SET quantity_received = :updated_qty_received, quantity_remaining = :qty_remaining, status = :status WHERE id = :id");
    
                // $stmt->bindParam(':qtyOrdered', $qtyOrdered, PDO::PARAM_INT);
                $stmt->bindParam(':updated_qty_received', $updated_qty_received, PDO::PARAM_INT);
                $stmt->bindParam(':qty_remaining', $qty_remaining, PDO::PARAM_INT);
                $stmt->bindParam(':status', $status, PDO::PARAM_STR);
                $stmt->bindParam(':id', $productId, PDO::PARAM_INT);
                $stmt->execute();


                //history
                $delivery_history = [
                    'order_product_id' => $productId,
                    'qty_received' => $delivered,
                    'date_received' => date('Y-m-d H:i:s'),
                    'date_updated' => date('Y-m-d H:i:s')
                ];

                $sql = "INSERT INTO order_product_history(order_product_id, qty_received, date_received, date_updated)
                VALUES (:order_product_id,:qty_received, :date_received, :date_updated)";
                       
                $stmt = $conn->prepare($sql);
                $stmt->execute($delivery_history);
                

                
            }

            
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
