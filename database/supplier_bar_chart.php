<?php
    include('connection.php');

    $stmt = $conn->prepare("SELECT id, supplier_name from suppliers");
    $stmt->execute();
    $rows = $stmt-> fetchAll();

    $categories = [];
    $bar_chart_data = [];


    $counter = 0;
    foreach($rows as $key => $row){
        $id = $row['id'];
        $categories[] = $row['supplier_name'];

        $colors = ['#000000','#00FFFF', '#0000FF', '#FFFF00' ,'#FF00FF' ,'#FFC0CB' ,'#00FF00 ', '#008000'];

        $stmt = $conn->prepare("SELECT COUNT(*) AS p_count FROM product_suppliers WHERE product_suppliers.supplier = '"
        . $id . "'");

        $stmt-> execute();
        $row = $stmt->fetch();

        if(!isset($colors[$key])){
            $counter = 0;
        }
        $count = $row['p_count'];
        $bar_chart_data[] = [
            'y' => (int) $count, 
            'color' => $colors[$counter]
        ];
        $counter++;
    }


?>