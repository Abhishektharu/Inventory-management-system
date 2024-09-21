<?php
require 'db_connection.php';  // Include your database connection

// Fetch all suppliers without coordinates in the new table
$sql = "SELECT id, supplier_location FROM suppliers WHERE id NOT IN (SELECT supplier_id FROM supplier_coordinates)";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$suppliers = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Define a User-Agent for the Nominatim request
$options = [
    'http' => [
        'header' => "User-Agent: MyInventoryApp/1.0 (your_email@example.com)\r\n"
    ]
];
$context = stream_context_create($options);

foreach ($suppliers as $supplier) {
    $location = urlencode($supplier['supplier_location']);
    $url = "https://nominatim.openstreetmap.org/search?q={$location}&format=json";

    // Make a request to the Nominatim API with the custom User-Agent header
    $response = @file_get_contents($url, false, $context);

    if ($response === FALSE) {
        echo "Failed to fetch coordinates for {$supplier['supplier_location']}\n";
        continue; // Skip to the next supplier if there's an error
    }

    $data = json_decode($response, true);

    if (!empty($data)) {
        $latitude = $data[0]['lat'];
        $longitude = $data[0]['lon'];

        // Insert the coordinates into the new supplier_coordinates table
        $insert_sql = "INSERT INTO supplier_coordinates (supplier_id, supplier_location, latitude, longitude) 
                       VALUES (:supplier_id, :supplier_location, :latitude, :longitude)";
        $insert_stmt = $pdo->prepare($insert_sql);
        $insert_stmt->execute([
            ':supplier_id' => $supplier['id'],
            ':supplier_location' => $supplier['supplier_location'],
            ':latitude' => $latitude,
            ':longitude' => $longitude
        ]);
        
        echo "Inserted coordinates for supplier {$supplier['supplier_location']} with lat: $latitude, lon: $longitude\n";
    } else {
        echo "No coordinates found for {$supplier['supplier_location']}\n";
    }
    sleep(1);  
}
?>
