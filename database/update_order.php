<?php
    // $purchase_orders = $_POST['payload'];
    // $conn = mysqli_connect("localhost","root","","inventory");
        // echo $return = $rowIds;
        // echo $return = $quantityReceived;
        // echo $return = $status;

    // foreach($purchase_orders as $po){
    //     $received = (int) $po['qtyRecieved'];
    //     $status = $po['status'];
    //     $row_id = $po['id'];
    //     $qty_ordered = (int) $po['qtyOrdered'];

    //     $qty_remaining = $qty_ordered - $received;

    //     $sql = "UPDATE order_product set quantity_received=?, status=? where id=?";

    //     $stmt = $conn-> prepare($sql);

    //     $stmt->execute([$received, $status, $row_id]);
    // }

    // $quantityReceived = $_POST['quantityReceived'];
    // echo $return = $quantityReceived;

//     if(isset($_POST['isUpdate']))
// {
    
//     $id = (int) $_POST['rowIds'];
//     $quantityReceived =(int) $_POST['quantityReceived'];
//     $quantityOrdered= (int) $_POST['quantityOrdered'];
//     $status = $_POST['status'];
    


//     $quantityRemaining = $quantityOrdered - $quantityReceived;

//     $query = "UPDATE order_product set quantity_ordered = '$quantityOrdered', quantity_received ='$quantityReceived', quantity_remaining = '$quantityRemaining', status='$status' where id='$id'";
//     $query_run = mysqli_query($conn, $query);

//     if($query_run)
//     {
//         echo $return  = "Successfully Stored";
//         $return = true;
//     }
//     else
//     {
//         echo $return  = "Something Went Wrong.!";
//     }

   
// }

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
            $productId = $productData['id'];
            $qtyOrdered = $productData['qtyOrdered'];
            $qtyReceived = $productData['qtyReceived'];
            $status = $productData['status'];

            // Prepare and execute an SQL query to update the product
            // $stmt = $pdo->prepare("UPDATE your_product_table SET qty_ordered = :qtyOrdered, qty_received = :qtyReceived, status = :status WHERE id = :id");
            $stmt = $pdo->prepare("UPDATE order_product SET quantity_received = :qtyReceived, status = :status, quantity_ordered = :qtyOrdered WHERE id = :id");

            $stmt->bindParam(':qtyOrdered', $qtyOrdered, PDO::PARAM_INT);
            $stmt->bindParam(':qtyReceived', $qtyReceived, PDO::PARAM_INT);
            $stmt->bindParam(':status', $status, PDO::PARAM_STR);
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
