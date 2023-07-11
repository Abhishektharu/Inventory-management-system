<?php
include('connection.php');

$table_name = $_SESSION['table'];







$stmt = $conn->prepare("SELECT * FROM products ORDER BY created_at DESC");
$stmt->execute();

$stmt->setFetchMode(PDO::FETCH_ASSOC);

return $stmt->fetchAll();

?>