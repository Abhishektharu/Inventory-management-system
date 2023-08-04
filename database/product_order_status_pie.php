<?php
    include('connection.php');
    $allStatus = ['complete', 'incomplete', 'pending'];
    $results = [];
    //loop through the status
    foreach($allStatus as $status){
        $stmt = $conn->prepare("SELECT COUNT(*) AS status_count FROM order_product WHERE order_product.status='"
        . $status . "'");

        $stmt-> execute();
        $row = $stmt->fetch();

        $count = $row['status_count'];

        $results[] = [
            'name'=> strtoupper($status),
            'y'=> (int)$count
        ];
    }
?>