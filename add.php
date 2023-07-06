<?php
    session_start();

    //capture the table mapping for all the columns
    include('database/table_columns.php');
    // var_dump($table_columns_mapping);
    // die;
    
    // image data
    // var_dump($_POST);
    // var_dump($_FILES);
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
        elseif($column == 'img'){

            //upload or move the file to directory uploads/products
            $target_dir = "uploads/products/";
            $file_data = $_FILES[$column];

            // $file_name = $file_data['name'];
            //rename the uploaded file name with custom name
            $file_name = $file_data['name'];
            $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
            $file_name = 'product-' . time() . '.'. $file_ext;

            $check = getimagesize($file_data['tmp_name']);
            //move the file;
            if($check){
                if(move_uploaded_file($file_data['tmp_name'], $target_dir . $file_name)){
                    // save the file_name to the database
                    $value = $file_name;
                }
                else{
                    // do not move the files;
                }
            }
        }
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