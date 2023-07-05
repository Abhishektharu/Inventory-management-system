<?php
    session_start();

    //capture the table mapping for all the columns
    include('database/table_columns.php');
    // var_dump($table_columns_mapping);
    // die;
    

    //extract product columns from session
    $table_name = $_SESSION['table'];
    $columns = $table_columns_mapping[$table_name];

    var_dump($columns);
    die;

    //for users data
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $encrypted = password_hash($password, PASSWORD_DEFAULT);

    try{

        $command = "INSERT INTO users(first_name, last_name, email, password, created_at, updated_at)
     VALUES ('".$first_name. "', 
            '".$last_name."',
            '".$email."',
            '".$encrypted."',
            NOW(), 
            NOW())";
            
            
            include('connection.php');
            $conn->exec($command);
            $response = [
                'success' => true,
                'message' => $first_name . ' ' .$last_name . ' successfully added to the system.'
            ];
        }

        catch(PDOException $e){
            // echo $e->getMessage();
            $response = [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
        
        $_SESSION['response'] = $response;
        header('Location: user_add.php');
        
?>