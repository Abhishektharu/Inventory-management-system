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
    // $quantityReceived = (int) $_POST['']
    $status = $_POST['status'];


    // $qty_remaining = $qty_ordered - $quantityReceived;

    $query = "UPDATE order_product set quantity_received ='$quantityReceived', status='$status' where id='$id'";
    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {
        echo $return  = "Successfully Stored";
    }
    else
    {
        echo $return  = "Something Went Wrong.!";
    }
}
