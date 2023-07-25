<!-- contains ajax or list of users delete operations -->
<?php
    $data = $_POST;
    $id = (int) $data['id'];
    $table = $data['table'];



    try{    
        include('connection.php');

        //for foreign key supplier to product_supplier table
        if($table === 'suppliers'){
            $suppplier_id = $id;
            $command = "DELETE FROM $table WHERE id= {$id}";
            $conn-> exec($command);
        }

        $command = "DELETE FROM $table WHERE id= {$id}";
            

            $conn->exec($command);

            echo json_encode([
                'success' => true,
            ]);
        }

        catch(PDOException $e){
            echo json_encode([
                'success' => false, 
                'message' => 'Error processing your request.'
            ]);
        }
?>

