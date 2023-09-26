<?php
//will add the columns in the database.
    session_start();

    //capture the table mapping for all the columns
    include('database/table_columns.php');


    //extract product columns from session
    $table_name = $_SESSION['table'];
    $columns = $table_columns_mapping[$table_name];
    var_dump($table_name);


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





    try{

        $sql = "INSERT INTO $table_name($table_properties)
     VALUES ($table_placeholders)";
            
            
            include('connection.php');
            $stmt = $conn -> prepare($sql);
            $stmt->execute($db_arr);
        
            $product_id = $conn->lastInsertId();

            if($table_name === 'products'){
                //if not empty
                $suppliers = isset($_POST['suppliers']) ? $_POST['suppliers']: [];
                if($suppliers){
                    //loop through the suppliers and add record
                    foreach ($suppliers as $supplier) {
                        $supplier_data = [
                            'supplier_id' => $supplier,
                            'product_id' => $product_id,
                            'updated_at' => date('Y-m-d H:i:s'),
                            'created_at' => date('Y-m-d H:i:s')
                        ];

                        $sql = "INSERT INTO product_suppliers(supplier, product, updated_at, created_at)
                        VALUES (:supplier_id,:product_id, :updated_at, :created_at)";
                               
                        $stmt = $conn->prepare($sql);
                        $stmt->execute($supplier_data);
                    }
                }
            }

        
            $product_id = $conn->lastInsertId();

            // if($table_name === 'products'){
            //     //if not empty
            //     $suppliers = isset($_POST['suppliers']) ? $_POST['suppliers']: [];
            //     if($suppliers){
            //         //loop through the suppliers and add record
            //         foreach ($suppliers as $supplier) {
            //             $supplier_data = [
            //                 'supplier_id' => $supplier,
            //                 'product_id' => $product_id,
            //                 'updated_at' => date('Y-m-d H:i:s'),
            //                 'created_at' => date('Y-m-d H:i:s')
            //             ];

            //             $sql = "INSERT INTO product_suppliers(supplier, product, updated_at, created_at)
            //             VALUES (:supplier_id,:product_id, :updated_at, :created_at)";
                               
            //             $stmt = $conn->prepare($sql);
            //             $stmt->execute($supplier_data);
            //         }
            //     }
            // }



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