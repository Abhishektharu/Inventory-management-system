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
?>