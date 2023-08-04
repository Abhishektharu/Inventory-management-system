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
    <title>view orders</title>
    <link rel="stylesheet" href="css/user_add.css">
    <link rel="shortcut icon" type="x-icon" href="Vector.svg">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
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
                                    <div class="column-7">
                                        <h1 class="section_header"><i class="fa fa-list"></i> List of Orders</h1>
                                        <div class="section_content">
                                            <div class="poListContainers">
                                                <?php
                                                $stmt = $conn->prepare("
                                                    SELECT order_product.id , products.product_name, order_product.quantity_ordered, users.first_name, users.last_name,
                                                    order_product.batch, order_product.quantity_received, users.last_name, suppliers.supplier_name, order_product.status, order_product.created_at
                                                     FROM
                                                                order_product, suppliers, products, users
                                                    WHERE
                                                        order_product.supplier = supplierS.id
                                                            AND
                                                        order_product.product = products.id
                                                            and
                                                        order_product.created_by = users.id
                                                        
                                                    order by
                                                        order_product.created_at DESC");
                                                $stmt->execute();
                                                $purchase_orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                                $data = [];
                                                foreach ($purchase_orders as $purchase_order) {
                                                    $data[$purchase_order['batch']][] = $purchase_order;
                                                }


                                                ?>
                                                <?php
                                                foreach ($data as $batch_id => $batch_pos) {

                                                ?>
                                                    <div class="poList" id="container-<?= $batch_id ?>">
                                                        <p>Batch #: <?= $batch_id ?></p>
                                                        <table>
                                                            <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Product</th>
                                                                    <th>Qty Ordered</th>
                                                                    <th>Qty Received</th>
                                                                    <th>Supplier</th>
                                                                    <th>Status</th>
                                                                    <th>Ordered By</th>
                                                                    <th>Created Date</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                foreach ($batch_pos as $index => $batch_po) {
                                                                ?>
                                                                    <tr>
                                                                        <td><?= $index + 1 ?></td>
                                                                        <td class="po_product"><?= $batch_po['product_name']  ?></td>
                                                                        <td class="po_qty_ordered"><?= $batch_po['quantity_ordered'] ?></td>
                                                                        <td class="po_qty_received"><?= $batch_po['quantity_received'] ?></td>
                                                                        <td class="po_qty_supplier"><?= $batch_po['supplier_name'] ?></td>
                                                                        <td class="po_qty_status ">
                                                                            <span class="po-badge po-badge-<?= $batch_po['status'] ?>">
                                                                                <?= $batch_po['status'] ?>
                                                                            </span>
                                                                        </td>
                                                                        <td><?= $batch_po['first_name'] . ' ' . $batch_po['last_name'] ?></td>
                                                                        <td>
                                                                            <?= $batch_po['created_at'] ?>
                                                                            <input type="hidden" class="po_qty_row_id" value="<?= $batch_po['id'] ?>">
                                                                        </td>
                                                                    </tr>
                                                                <?php } ?>
                                                            </tbody>
                                                        </table>
                                                        <div class="poOrderUpdateBtn alignRight">
                                                            <button class="appbtn updatePoBtn" data-id="<?= $batch_id ?>">Update</button>
                                                        </div>
                                                    </div>

                                                <?php } ?>
                                            </div>
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

                targetElement = e.target; //target element
                classList = targetElement.classList; // returns class

                if (classList.contains('updatePoBtn')) {
                    e.preventDefault();

                    batchNumberContainer = 'container-' + targetElement.dataset.id;

                    productList = document.querySelectorAll('#' + batchNumberContainer + ' .po_product');
                    qtyOrderedList = document.querySelectorAll('#' + batchNumberContainer + ' .po_qty_ordered');
                    qtyReceivedList = document.querySelectorAll('#' + batchNumberContainer + ' .po_qty_received');
                    supplierList = document.querySelectorAll('#' + batchNumberContainer + ' .po_qty_supplier');
                    statusList = document.querySelectorAll('#' + batchNumberContainer + ' .po_qty_status');

                    poListsArr = [];

                    for (var i = 0; i < productList.length; i++) {
                        poListsArr.push({
                            name: productList[i].innerText,
                            qtyOrdered: qtyOrderedList[i].innerText,
                            qtyReceived: qtyReceivedList[i].innerText,
                            supplier: supplierList[i].innerText,
                            status: statusList[i].innerText
                        });
                    }

                    productList.forEach((product, key) => {
                        poListsArr[key]['product'] = product.innerText;
                    });

                    //store in html
                    var poListHtml = '\
                    <table>\
                            <thead>\
                                <tr>\
                                    <th>Product Name</th>\
                                    <th>Qty Ordered</th>\
                                    <th>Qty Received</th>\
                                    <th>Supplier</th>\
                                    <th>Status</th>\
                                </tr>\
                            </thead>\
                            <tbody>';

                    poListsArr.forEach((poList) => {
                        poListHtml += '\
                                <tr>\
                                        <td class="po_product">' + poList.name + '</td>\
                                        <td class="po_qty_ordered">' + poList.qtyOrdered + '</td>\
                                        <td class="po_qty_received">' + poList.qtyReceived + '</td>\
                                        <td class="po_qty_supplier"><' + poList.supplier + '</td>\
                                        <td>\
                                            <select>\
                                                <option value="pending" ' + (poList.status == 'pending' ? 'selected' : '') + '>pending</option>\
                                                <option value="complete" ' + (poList.status == 'pending' ? 'selected' : '') + '>pending</option>\
                                            </select>\
                                            <input type="hidden" class="po_qty_row_id" value="<?= $batch_po['id'] ?>">\
                                        <\td>\
                                </tr>\
                            ';
                        console.log(poList);
                    });

                    poListHtml += '</tbody></table>';
                    console.log(poListHtml);
                    



                    // if (window.confirm('Are you sure to delete ' + pName + ' ?')) {
                    //     $.ajax({
                    //         method: 'POST',
                    //         data: {
                    //             id: pId,
                    //             table: 'products'
                    //         },

                    //         url: 'database/delete.php',
                    //         dataType: 'json',
                    //         success: function(data) {
                    //             if (data.success) {
                    //                 if (window.confirm(data.message)) {
                    //                     location.reload();
                    //                 }
                    //             } else window.alert(data.message);
                    //         }
                    //     })
                    // } else {
                    //     console.log("not delete");
                    // }
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