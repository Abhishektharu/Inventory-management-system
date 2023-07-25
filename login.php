<?php
session_start();

if (isset($_SESSION['user'])) header('Location: dashboard.php');
$error_message = '';
if ($_POST) {
    include('connection.php');

    $username = $_POST['username'];
    $password = $_POST['password'];
    // $password = $_POST['password'];

    $query = 'SELECT * FROM users WHERE users.email="'. $username .'" AND users.password="'. $password .'"';
    // $stmt = $conn->prepare($query);

    // $stmt->execute();
    // $stmt->setFetchMode(PDO::FETCH_ASSOC);

    // $users = $stmt->fetchAll();



    // $user_exist = false;
    // foreach ($users as $user) {

    //     $upass = $user['password'];
    //     if (password_verify($password, $upass)) {
    //         $user_exist = true;
    //         $_SESSION['user'] = $user;
    //         break;
    //     }
    // }

    // if($user_exist) 
    // {
    //     header('Location: dashboard.php');
    // }

    // else 
    // {
    //     $error_message = 'Please enter correct username or password.';
    // }

    // if($stmt -> rowCount() > 0){
    //     $stmt->setFetchMode(PDO::FETCH_ASSOC);
    //     $user = $stmt->fetchAll()[0];
    //     $_SESSION['user'] = $user;

    //     header('Location: dashboard.php');
    // }
    // else{
    //     $error_message = 'please insert correct username and password';
    // }

    $stmt = $conn->prepare("SELECT * FROM users");
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    $users = $stmt->fetchAll();

    $user_exist = false;
    foreach ($users as $user) {
        $upass = $user['password'];

        if (password_verify($password, $upass)) {
            $user_exist = true;
            //current session user
            $_SESSION['user'] = $user;
            break;
        }
    }

    if($user_exist) 
    {
        header('Location: dashboard.php');
    }

    else 
    {
        $error_message = 'Please enter correct username or password.';
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>IMS Login - Inventory Management System</title>
    <link rel="stylesheet" type="text/css" href="css/forms.css">
    <link rel="shortcut icon" type="x-icon" href="Vector.svg">
    <style>
        div#errorMessage {
            background-color: #fff;
            text-align: center;
            color: red;
            font-size: 20px;
            padding: 11px;
        }
    </style>
</head>

<body id="loginBody">
    <?php
    if (!empty($error_message)) {
    ?>
        <div id="errorMessage">
            <p>Error: <?= $error_message ?></p>
        </div>
    <?php }

    ?>
    <div class="content">
        <div class="image-box">
            <img src="ims.png" alt="Image">
        </div>

        <div class="form-field">
            <div class="text">Login</div>
            <form action="login.php" method="post">
                <div class="input">
                    <label for="username">email</label>
                    <input type="text" name="username" placeholder="username" required >
                </div>

                <div class="input">
                    <label for="password">Password</label>
                    <input type="password" name="password" placeholder="password">
                </div>

                <div class="login">
                    <button type="submit" class="btn" name="login">Login</button>
                </div>

               <div class="back-login">
                    <a href="homepage.php" class="hover-back-login"> BACK</a>
               </div>

            </form>

        </div>

    </div>
</body>
</html>