<?php
    $conn = mysqli_connect("localhost","root","","inventory");


    if(isset($_POST['checking_update'])){
        (int) $id = $_POST['uId'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];

        $query = "UPDATE users SET first_name = '$fname', last_name = '$lname', email = '$email' where id = '$id'";
        $query_run = mysqli_query($conn, $query);

        if($query_run){
            echo $return = "data saved";
        }
        else{
            echo $return = "data not saved";
        }

    }
    if(isset($_POST['checking_supplier'])){
        // var_dump($_POST);
        (int) $id = $_POST['uId'];
        $supplier_name = $_POST['supplier_name'];
        $supplier_location = $_POST['supplier_location'];
        $email = $_POST['email'];

        $query = "UPDATE suppliers SET supplier_name = '$supplier_name', supplier_location = '$supplier_location', email = '$email', updated_at = NOW() where id = '$id'";
        $query_run = mysqli_query($conn, $query);

        if($query_run){
            echo $return = "data saved";
        }
        else{
            echo $return = "data not saved";
        }

    }

    if(isset($_POST['checking_product_view'])){
        (int) $id = $_POST['uId'];
        $edit_pname = $_POST['edit_pname'];
        $edit_description = $_POST['edit_description'];

        $query = "UPDATE products SET product_name = '$edit_pname', description = '$edit_description', updated_at = NOW() where id = '$id'";
        $query_run = mysqli_query($conn, $query);

        if($query_run){
            echo $return = "data saved";
        }
        else{
            echo $return = "data not saved";
        }

    }

    
?>