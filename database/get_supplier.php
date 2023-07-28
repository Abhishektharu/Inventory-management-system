<?php
include('connection.php');
$id = $_GET['id'];
$stmt = $conn->prepare("
                        SELECT supplier_name, suppliers.id
                        FROM suppliers, product_suppliers
                        WHERE
                            product_suppliers.product = $id
                            AND
                            product_suppliers.supplier = suppliers.id;
");

$stmt->execute();
$suppliers = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($suppliers);


?>