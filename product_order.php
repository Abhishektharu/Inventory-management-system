<?php
//start the session.
session_start();

if (!isset($_SESSION['user'])) header('Location: login.php');

$show_table = 'products';
$products = include('database/show.php');
//convert array to string
$products = json_encode($products);


$response_message = '';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Product - Inventory Manangement System</title>
    <link rel="stylesheet" href="css/user_add.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <link rel="shortcut icon" type="x-icon" href="Vector.svg">
    <link rel="stylesheet" href="css/user_add2.css">
    <link rel="stylesheet" href="css/supplier.css">

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
                                        <h1 class="section_header"><i class="fa fa-plus"></i> Order Product</h1>
                                        <div class="alignRight">
                                            <button class="orderProductBtn"> Add New Product Order </button>
                                        </div>
                                        <div id="orderProductLists">
                                            <div class="orderProductRow">
                                                <div>
                                                    <label for="product_name" >Product Name  </label>
                                                    <select name="product_name" id="product_name"class="productNameSelect">
                                                        <option>product 1</option>
                                                        <option>product 2</option>
                                                        <option>product 3</option>
                                                    </select>
                                                </div>

                                                <div class="suppliersRows">

                                                    <div class="row">

                                                        <div style="width: 50%;">
                                                        <p class="supplierName">Supplier 1</p>
                                                        </div>
                                                        
                                                        <div style="width: 50%;">
                                                            <label for="product_name" >Quantity: </label>
                                                            <input type="number" class="appFormInput" id="product_quantity" placeholder="Enter product name .." name="product_name" />
                                                        </div>
                                                    </div>

                                                    <div class="row">

                                                        <div style="width: 50%;">
                                                        <p class="supplierName">Supplier 2</p>
                                                        </div>
                                                        
                                                        <div style="width: 50%;">
                                                            <label for="product_name" >Quantity: </label>
                                                            <input type="number" class="appFormInput" id="product_quantity" placeholder="Enter product name .." name="product_name" />
                                                        </div>
                                                    </div>

                                                </div> 
                                            </div>
                                        </div>

                                        <div class="alignRight marginBtn">
                                            <button class="orderBtn">Submit Order</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>

        </div>

        <!-- side bar or nav bar out of section and inside of wrapper -->
        <?php
        include('partials/app_sidebar.php');
        ?>
    </div>

    <script>
        var products = <?= $products ?>;
        console.log(products);
    </script>
</body>
<script src="js/script.js"></script>
<script src="js/jquery/jquery-3.7.0.min.js"></script>

</html>