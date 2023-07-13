<!-- contains ajax or list of users delete operations -->
<?php
    $data = $_POST;
    $id = (int) $data['id'];
    $table = $data['table'];

    
    try{

        $command = "DELETE FROM $table WHERE id= {$id}";
            
            include('connection.php');

            $conn->exec($command);
            // The json_encode() function is used to encode a value to JSON format.
            // $age = array("Peter"=>35, "Ben"=>37, "Joe"=>43);

            // echo json_encode($age);
            //
            // {"Peter":35,"Ben":37,"Joe":43} 

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

