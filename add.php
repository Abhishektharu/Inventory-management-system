<?php
    session_start();

    //capture the table mapping for all the columns
    include('database/table_columns.php');
    // var_dump($table_columns_mapping);
    // die;
    

    //extract product columns from session
    $table_name = $_SESSION['table'];
    $columns = $table_columns_mapping[$table_name];


    //loop through the columns
    $db_arr = [];
    $user = $_SESSION['user'];

    foreach($columns as $column){
        // set the current date time of products;
        if(in_array($column, ['created_at', 'updated_at'])) $value = date('Y-m-d H:i:s');
        elseif($column == 'created_by') $value = $user['id'];
        elseif($column == 'password') $value = password_hash($_POST[$column], PASSWORD_DEFAULT);
        else $value = isset($_POST[$column]) ? $_POST[$column] : '';

        $db_arr[$column] = $value;  
    }


    $table_properties = implode(", ", array_keys($db_arr));
    $table_placeholders = ':'. implode(", :", array_keys($db_arr));



    //for users data
    // $first_name = $_POST['first_name'];
    // $last_name = $_POST['last_name'];
    // $email = $_POST['email'];
    // $password = $_POST['password'];

    // $encrypted = password_hash($password, PASSWORD_DEFAULT);

    try{

        $sql = "INSERT INTO $table_name($table_properties)
     VALUES ($table_placeholders)";
            
            
            include('connection.php');
            $stmt = $conn -> prepare($sql);
            $stmt->execute($db_arr);
            $response =  [
                'success' => true,
                'message' => $first_name . ' '. $last_name. ' successfully added.'
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
        header('Location: ./' . $_SESSION['redirect_to']);
        
?>