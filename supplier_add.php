<?php
//start the session.
session_start();

if (!isset($_SESSION['user'])) header('Location: homepage.php');
$_SESSION['table'] = 'suppliers';
$_SESSION['redirect_to'] = 'supplier_add.php';

$user = $_SESSION['user'];
$response_message = '';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supplier Add - Inventory Manangement System</title>
    <link rel="stylesheet" href="css/user_add.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <link rel="shortcut icon" type="x-icon" href="Vector.svg">
    <link rel="stylesheet" href="css/user_add2.css">

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
                    <div class="userAddFormContainer">


                        <div class="dashboard_content">
                            <div class="dashboard_content_main">
                                <div class="row">
                                    <div class="column-5">
                                        <h1 class="section_header"><i class="fa fa-plus"></i> Add Supplier</h1>
                                        <div id="userAddFormContainer">
                                            <form action="add.php" method="POST" class="appForm" enctype="multipart/form-data">
                                                <div class="appFormInputContainer">
                                                    <label for="supplier_name">Supplier Name</label>
                                                    <input type="text" id="supplier_name" name="supplier_name" class="appFormInput" placeholder="Enter supplier name" required/>
                                                </div>

                                                <!-- css written in user_add3.css -->
                                                <div class="appFormInputContainerother">
                                                    <label for="supplier_location">Location</label>
                                                    <input type="text" id="supplier_location" name="supplier_location" class="appFormInput productTextAreaInputLocation" placeholder="Enter supplier location ..">
                                                    
                                                </div>

                                                <div class="appFormInputContainer">
                                                    <label for="description">email</label>
                                                    <input type="text" id="supplier_email" name="email" class="appFormInput productTextAreaInput" placeholder="Enter supplier email ..">

                                                    </select>
                                                </div>

                                                <button type="submit" class="appBtn"><i class="fa fa-plus"></i> Add Supplier</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
                <?php
                if (isset($_SESSION['response'])) {
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

        <!-- side bar or nav bar out of section and inside of wrapper -->
        <?php
        include('partials/app_sidebar.php');
        ?>
    </div>
</body>
<script src="js/script.js"></script>
<script src="js/jquery/jquery-3.7.0.min.js"></script>


</html>