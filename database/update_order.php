<?php
    // $purchase_orders = $_POST['payload'];
    $conn = mysqli_connect("localhost","root","","inventory");
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

    if(isset($_POST['isUpdate']))
{
    
    $id = (int) $_POST['rowIds'];
    $quantityReceived =(int) $_POST['quantityReceived'];
    $quantityOrdered= (int) $_POST['quantityOrdered'];
    $status = $_POST['status'];
    


    $quantityRemaining = $quantityOrdered - $quantityReceived;

    $query = "UPDATE order_product set quantity_ordered = '$quantityOrdered', quantity_received ='$quantityReceived', quantity_remaining = '$quantityRemaining', status='$status' where id='$id'";
    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {
        echo $return  = "Successfully Stored";
        $return = true;
    }
    else
    {
        echo $return  = "Something Went Wrong.!";
    }

}
