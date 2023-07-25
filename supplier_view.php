<?php
//start the session.
session_start();

if (!isset($_SESSION['user'])) header('Location: login.php');

$show_table = 'suppliers';


$suppliers = include('database/show.php');


$response_message = '';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supplier view Inventory Manangement System</title>
    <link rel="stylesheet" href="css/user_add.css">
    <link rel="shortcut icon" type="x-icon" href="Vector.svg">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
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
                                    <div class="column-7">
                                        <h1 class="section_header"><i class="fa fa-list"></i> List of Suppliers</h1>
                                        <div class="section_content">
                                            <div class="users">
                                                <table>
                                                    <thead>

                                                        <tr>
                                                            <th>nu</th>
                                                            <th>Supplier Name</th>
                                                            <th>Supplier Location</th>
                                                            <th>Email</th>
                                                            <th>products</th>
                                                            <th>created by</th>
                                                            <th>Created At</th>
                                                            <th>Updated At</th>
                                                            <th>Option</th>
                                                        </tr>
                                                    </thead>

                                                    <!-- table body of add users  -->
                                                    <tbody>
                                                        <?php foreach ($suppliers as $index => $supplier) {
                                                        ?>
                                                            <tr>
                                                                <td><?= $index + 1 ?></td>
                                                                <td><?= $supplier['supplier_name'] ?> </td>
                                                                <td><?= $supplier['supplier_location'] ?></td>
                                                                <td><?= $supplier['email'] ?></td>
                                                                <td>
                                                                    <?php

                                                                    $product_list = '-';

                                                                    $sid = $supplier['id'];
                                                                    $stmt = $conn->prepare("SELECT product_name FROM products, product_suppliers WHERE product_suppliers.supplier = $sid AND product_suppliers.product = products.id");
                                                                    $stmt->execute();
                                                                    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                                                    if ($row) {
                                                                        $product_arr = array_column($row, 'product_name');
                                                                        $product_list = '<li>' . implode("</li><li>", $product_arr);
                                                                    }
                                                                    echo $product_list;
                                                                    
                                                                    ?>
                                                                </td>

                                                                <td>
                                                                    <?php
                                                                    $uid = $supplier['created_by'];
                                                                    $stmt = $conn->prepare("SELECT * FROM users WHERE id = $uid");
                                                                    $stmt->execute();
                                                                    $row = $stmt -> fetch(PDO::FETCH_ASSOC);

                                                                    $created_by_name = $row['first_name'] . ' ' . $row['last_name'];
                                                                    echo $created_by_name;
                                                                    ?>
                                                                </td>

                                                                <!-- set month day year using php  -->
                                                                <td><?= date('M d, Y @ h:i:s A', strtotime($supplier['created_at'])) ?></td>
                                                                <td><?= date('M d, Y @ h:i:s A', strtotime($supplier['updated_at'])) ?></td>


                                                                <!-- adding edit and delete option` -->
                                                                <td>
                                                                    <!-- <a href=""><i class="fa fa-pencil"></i>Edit</a> -->
                                                                    <a href="" class="deleteSupplier" data-name="<?= $supplier['supplier_name'] ?>" data-sid="<?= $supplier['id'] ?>"> <i class="fa fa-trash"></i>Delete</a>
                                                                </td>

                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                                <p class="userCount"><?= count($suppliers) ?> Suppliers </p>

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
    function script() {

        this.registerEvents = function() {
            document.addEventListener('click', function(e) {
                // alert('clicked');
                // return false;
                targetElement = e.target; //target element
                classList = targetElement.classList; // returns class

                // foreign key productSupplier from supplier table

                if (classList.contains('deleteSupplier')) {
                    e.preventDefault();

                    sId = targetElement.dataset.sid;
                    pName = targetElement.dataset.name;




                    if (window.confirm('Are you sure to delete ' + pName + ' ?')) {

                        $.ajax({
                            method: 'POST',
                            data: {
                                id: sId,
                                table: 'suppliers'
                            },

                            url: 'database/delete.php',
                            dataType: 'json',
                            success: function(data) {
                                if (data.success) {
                                    if (window.confirm(data.message)) {
                                        location.reload();
                                    }
                                } else window.alert(data.message);
                            }
                        })
                    } else {
                        console.log("not delete");
                    }
                }
            });
        }



        this.initialize = function() {
            this.registerEvents();
        }
    }
    var script = new script;
    script.initialize();
</script>


</html>