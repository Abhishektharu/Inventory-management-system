<?php
// start the session.
session_start();

if (!isset($_SESSION['user'])) header('Location: homepage.php');
$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/sidebar.css">
    <style>
        .wrapper .section .container {
            margin: 30px;
            background: #fff;
            padding: 50px;
            line-height: 28px;
            color: green;
        }
    </style>
</head>

<body>
    <div class="wrapper">


        <!--Top menu -->
        <div class="section">
            <?php
            include('partials/top_nav.php');
            ?>


            <!-- container main -->
            <div class="container"> nobis, delectus asperiores autem ab et placeat ducimus dolor nulla!
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae explicabo voluptate doloribus, blanditiis quidem id aliquid laboriosam dicta ipsum! Harum fugit illo, magni earum nisi eos ab tenetur aliquid molestiae. Commodi, repudiandae dolor.

            </div>
        </div>
        <?php
        include('partials/app_sidebar.php');
        ?>
    </div>

    <script src="js/script.js"></script>
</body>

</html>