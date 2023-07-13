<?php
//start the session.
session_start();

if (!isset($_SESSION['user'])) header('Location: homepage.php');
$_SESSION['table'] = 'products';


$products = include('database/show_product.php');
// var_dump($products);
// die;

$response_message = '';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product view Inventory Manangement System</title>
    <link rel="stylesheet" href="css/user_add.css">
    <link rel="shortcut icon" type="x-icon" href="Vector.svg">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <link rel="stylesheet" href="css/user_add2.css">
    <!-- <link rel="stylesheet" href="css/user_add3.css"> -->
    <style>
        .productImages{
            height: 25px;
            width: 25px;
            border-radius: 5px;
        }
    </style>

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
                                    <div class="column-7">
                                        <h1 class="section_header"><i class="fa fa-list"></i> List of Products</h1>
                                        <div class="section_content">
                                            <div class="users">
                                                <table>
                                                    <thead>

                                                        <tr>
                                                            <th>nu</th>
                                                            <th>Image</th>
                                                            <th>Product Name</th>
                                                            <th>Description</th>
                                                            <th>created by</th>
                                                            <th>Created At</th>
                                                            <th>Updated At</th>
                                                            <th>Option</th>
                                                        </tr>
                                                    </thead>

                                                    <!-- table body of add users  -->
                                                    <tbody>
                                                        <?php foreach ($products as $index => $product) {
                                                        ?>
                                                            <tr>
                                                                <td><?= $index + 1 ?></td>
                                                                <!-- //image section  -->
                                                                <td class="firstName">
                                                                    <!-- css written in internal css of product_view.php -->
                                                                <img class="productImages" src= "uploads/products/<?= $product['img'] ?>" alt=""/>
                                                                </td>
                                                                <td class="lastName"><?= $product['product_name'] ?></td>
                                                                <td class="email"><?= $product['description'] ?></td>
                                                                <td><?= $product['created_by'] ?></td>
                                                                <!-- set month day year using php  -->
                                                                <td><?= date('M d, Y @ h:i:s A', strtotime($product['created_at'])) ?></td>
                                                                <td><?= date('M d, Y @ h:i:s A', strtotime($product['updated_at'])) ?></td>


                                                                <!-- adding edit and delete option` -->
                                                                <td>
                                                                    <!-- <a href=""><i class="fa fa-pencil"></i>Edit</a> -->

                                                                    <!-- <a href="" class="deleteProduct" data-pid="<?= $product['product_name'] ?>" data-fname="<?= $user['first_name'] ?>" data-lname="<?= $user['last_name'] ?>"> <i class="fa fa-trash"></i>Delete</a> -->
                                                                    <a href="" class="deleteProduct" data-name="<?= $product['product_name'] ?>" data-pid="<?= $product['id'] ?>"> <i class="fa fa-trash"></i>Delete</a>
                                                                </td>

                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                                <p class="userCount"><?= count($products) ?> Products </p>
                                            </div>
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

<script>
    // delete product
    function script(){

        this.registerEvents = function() {
                document.addEventListener('click', function(e) {
                    // alert('clicked');
                    // return false;
                    targetElement = e.target; //target element
                    classList = targetElement.classList; // returns class



                    if (classList.contains('deleteProduct')) {
                        e.preventDefault();

                        pId = targetElement.dataset.pid;
                        pName = targetElement.dataset.name;
                        



                        if (window.confirm('Are you sure to delete '  + pName + ' ?')) {

                            $.ajax({
                                method: 'POST',
                                data: {
                                    id: pId,
                                    table: 'products'
                                },

                                url: 'database/delete.php',
                                dataType: 'json',
                                success: function(data){
                                    if(data.success){
                                        if(window.confirm(data.message)){
                                            location.reload();
                                        }
                                    }
                                    else window.alert(data.message);
                                }
                            })
                        } else {
                            console.log("not delete");
                        }
                    }
                });
            }



        this.initialize = function(){
            this.registerEvents();
        }
    }
    var script = new script;
    script.initialize();
</script>


</html>
