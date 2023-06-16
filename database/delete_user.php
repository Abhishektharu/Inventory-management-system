<!-- contains ajax or list of users delete operations -->
<?php
    $data = $_POST;
    $user_id = (int) $data['user_id'];
    $first_name = $data['f_name'];
    $last_name = $data['l_name'];

    try{

        $command = "DELETE FROM users WHERE id= {$user_id}";
            
            include('connection.php');

            $conn->exec($command);

            // The json_encode() function is used to encode a value to JSON format.
            // $age = array("Peter"=>35, "Ben"=>37, "Joe"=>43);

            // echo json_encode($age);
            //
            // {"Peter":35,"Ben":37,"Joe":43} 

            echo json_encode([
                'success' => true,
                'message' => $first_name . ' ' . $last_name . ' successfully deleted.'
            ]);
        }

        catch(PDOException $e){
            echo json_encode([
                'success' => false, 
                'message' => 'Error processing your request.'
            ]);
        }
?>

