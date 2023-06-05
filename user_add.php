<?php
//start the session.
session_start();

if (!isset($_SESSION['user'])) header('Location: homepage.php');
$_SESSION['table'] = 'users';

$user = $_SESSION['user'];
$response_message = '';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/user_add.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
</head>

<body>
    <!-- dashboardMainContainer -->
    <div class="wrapper">


        <!--Top menu -->
        <div class="section">
            <?php
            include('partials/top_nav.php');
            ?>


            <!-- container main -->
            <div class="container">
                <div class="dashboard_content_main">
                    <form action="users_add.php" method="POST" class="appForm">
                        <div class="appFormInputContainer">
                            <label for="first_name">First Name</label>
                            <input type="text" id="first_name" name="first_name" class="appFormInput" />
                        </div>

                        <div class="appFormInputContainer">
                            <label for="last_name">Last Name</label>
                            <input type="text" id="last_name" name="last_name" class="appFormInput" />
                        </div>

                        <div class="appFormInputContainer">
                            <label for="email">email</label>
                            <input type="text" id="email" name="email" class="appFormInput" />
                        </div>

                        <div class="appFormInputContainer">
                            <label for="password">password</label>
                            <input type="password" id="password" name="password" class="appFormInput" />
                        </div>
                        
                        <input type="hidden" name="table" value="users" />
                        <button type="submit" class="appBtn"><i class="fa fa-plus"></i> Add User</button>
                    </form>

                    <?php 
                        if(isset($_SESSION['response'])){
                            $response_message = $_SESSION['response']['message'];
                            $is_success = $_SESSION['response']['success'];
                        }
                    ?>

                    <div class="responseMessage">
                        <p class="<?= $is_success ? 'responseMessage_success' : 'responseMessage_error' ?>">
                            <?= $response_message ?>
                    </p>
                    </div>

                    <?php unset($_SESSION['response']); ?>
                </div>
            </div>

        </div>

        <!-- side bar or nav bar out of section and inside of wrapper -->
        <?php
        include('partials/app_sidebar.php');
        ?>
    </div>
</body>

</html>