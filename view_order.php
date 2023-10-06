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
    <link rel="stylesheet" href="css/sidebar.css">

    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">



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
            <div class="containerMain">


                <div class="dashboard_content_main">
                    <div class="userAddFormContainer">


                        <div class="dashboard_content">
                            <div class="dashboard_content_main">
                                <div class="row">
                                    <div class="column-7">
                                        <h1 class="section_header"><i class="fa fa-list"></i> List of Orders</h1>
                                        <div class="section_content">
                                            <!-- ################################################################################################################################################################# -->

                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-xl">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5 batchId" id="exampleModalLabel">Update product-orders:</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body ">
                                                            <table class="table table-bordered table_data">
                                                            </table>
                                                        </div>


                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary close" data-bs-dismiss="modal">Close</button>
                                                            <button type="button" class="btn btn-primary " id="updateOrder">Update</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- ########################################################################################################################################################## -->
                                        <div class="modal fade" id="history_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">History of orders</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="table table-bordered history_modal ">
                                                        No records were found...
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <!-- ########################################################################################################################################### -->
                                        <div class="poListContainers">
                                            <?php
                                            $stmt = $conn->prepare("
                                                    SELECT order_product.id , order_product.product, products.product_name, order_product.quantity_ordered, order_product.quantity_remaining, users.first_name, users.last_name,
                                                    order_product.batch, order_product.quantity_received, users.last_name, suppliers.supplier_name, order_product.status, order_product.created_at
                                                     FROM
                                                                order_product, suppliers, products, users
                                                    WHERE
                                                        order_product.supplier = suppliers.id
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
                                                                <th>Qty Rem</th>
                                                                <th>Supplier</th>
                                                                <th>Status</th>
                                                                <th>Ordered By</th>
                                                                <th>Created Date</th>
                                                                <th>Delivery History</th>
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
                                                                    <td class="po_qty_remaining"><?= $batch_po['quantity_remaining'] ?></td>
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
                                                                        <input type="hidden" class="po_qty_product_id" value="<?= $batch_po['product'] ?>">
                                                                    </td>
                                                                    <td>
                                                                        <button class="appbtn deliveryBtn" data-bs-toggle="modal" data-bs-target="#history_modal" data-id="<?= $batch_po['id'] ?>">Delivery History</button>
                                                                    </td>
                                                                </tr>
                                                            <?php } ?>
                                                        </tbody>
                                                    </table>
                                                    <div class="poOrderUpdateBtn alignRight">
                                                        <button class="appbtn updatePoBtn" data-bs-toggle="modal" data-bs-target="#exampleModal" data-id="<?= $batch_id ?>">Update</button>
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



        <!-- side bar or nav bar out of section and inside of wrapper -->
        <?php
        include('partials/app_sidebar.php');
        ?>
    </div>
</body>
<script src="js/script.js"></script>
<script src="js/jquery/jquery-3.7.0.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>

<script>
    function script() {

        this.registerEvents = function() {
            document.addEventListener('click', function(e) {

                targetElement = e.target; //target element
                classList = targetElement.classList; // returns class
                
                if (classList.contains('updatePoBtn')) {
                    e.preventDefault();
                    $('.table_data').empty();



                    batchNumber = targetElement.dataset.id;
                    batchNumberContainer = 'container-' + targetElement.dataset.id;

                    productList = document.querySelectorAll('#' + batchNumberContainer + ' .po_product');
                    qtyOrderedList = document.querySelectorAll('#' + batchNumberContainer + ' .po_qty_ordered');
                    qtyReceivedList = document.querySelectorAll('#' + batchNumberContainer + ' .po_qty_received');
                    supplierList = document.querySelectorAll('#' + batchNumberContainer + ' .po_qty_supplier');
                    statusList = document.querySelectorAll('#' + batchNumberContainer + ' .po_qty_status');
                    rowIds = document.querySelectorAll('#' + batchNumberContainer + ' .po_qty_row_id');
                    // console.log(rowIds);

                    poListsArr = [];

                    for (var i = 0; i < productList.length; i++) {
                        poListsArr.push({
                            name: productList[i].innerText,
                            qtyOrdered: qtyOrderedList[i].innerText,
                            qtyReceived: qtyReceivedList[i].innerText,
                            supplier: supplierList[i].innerText,
                            status: statusList[i].innerText,
                            id: rowIds[i].value
                        });
                    }

                    productList.forEach((product, key) => {
                        poListsArr[key]['product'] = product.innerText;
                    });

                    //store in html
                    var poListHtml = '\
                    <table id="formTable' + batchNumber + '">\
                            <thead>\
                                <tr>\
                                    <th scope="col">Name </th>\
                                    <th scope="col"> Qty Ordered </th>\
                                    <th scope="col"> Qty Received </th>\
                                    <th scope="col"> Qty Delivered </th>\
                                    <th scope="col">Supplier</th>\
                                    <th scope="col">Status</th>\
                                </tr>\
                            </thead>\
                            <tbody>';

                    poListsArr.forEach((poList) => {
                        poListHtml += '\
                                <tr>\
                                        <td class="po_product">' + poList.name + '</td>\
                                        <td class="po_qty_ordered" id="qtyOrdered">' + poList.qtyOrdered + ' </td>\
                                        <td class="po_qty_received" id="qtyRecieved">' + poList.qtyReceived + ' </td>\
                                        <td class="po_qty_received" ><input type="number" id="qtyDelivered"value="0"/></td>\
                                        <td class="po_qty_supplier">' + poList.supplier + '</td>\
                                        <td>\
                                            <select class="po_qty_status" id="status">\
                                                <option value="pending" ' + (poList.status == 'pending' ? 'selected' : '') + '>pending</option>\
                                                <option value="complete" ' + (poList.status == 'complete' ? 'selected' : '') + '>complete</option>\
                                                <option value="incomplete" ' + (poList.status == 'incomplete' ? 'selected' : '') + '>incomplete</option>\
                                            </select>\
                                            <input type="hidden" id="rowId"class="po_qty_row_id" value="' + poList.id + '">\
                                        </td>\
                                </tr>\
                            ';
                        // console.log(poListsArr);
                    });

                    poListHtml += '</tbody></table>';
                    // console.log(poListHtml);

                    $('.table_data').append(poListHtml);


                    $(document).ready(function() {
                        $("#updateOrder").click(function() {
                            // alert('hi');
                            formtablecontainer = 'formTable: ' + batchNumber;

                            qtyOrdered = document.querySelector('#' + batchNumberContainer + ' .po_qty_received')

                            // console.log(qtyOrdered);
                            statusList = document.querySelectorAll('#' + batchNumberContainer + ' .po_qty_status');
                            rowIds = document.querySelectorAll('#' + batchNumberContainer + ' .po_qty_row_id');
                            qtyOrdered = document.querySelector('#' + batchNumberContainer + ' .po_qty_ordered')
                            pIds = document.querySelector('#' + batchNumberContainer + ' .po_qty_product_id')
                            console.log(pIds);

                            poListsArrForm = [];
                            // Iterate through table rows and collect data
                            var productList = [];

                            // Assuming you have already selected the elements with class .po_qty_product_id into pIds
                            var pIds = document.querySelectorAll('#' + batchNumberContainer + ' .po_qty_product_id');

                            $("#formTable" + batchNumber + " tbody tr").each(function(index) {
                                var productName = $(this).find(".po_product").text();
                                var qtyOrdered = $(this).find("#qtyOrdered").text();
                                var qtyReceived = $(this).find("#qtyRecieved").text();
                                var supplier = $(this).find(".po_qty_supplier").text();
                                var status = $(this).find("#status").val();
                                var rowId = $(this).find(".po_qty_row_id").val();
                                var qtyDelivered = $(this).find("#qtyDelivered").val();

                                var pidValue = pIds[index].value; // Get the value from pIds at the same index

                                var productData = {
                                    name: productName,
                                    qtyReceived: qtyReceived,
                                    qtyOrdered: qtyOrdered,
                                    supplier: supplier,
                                    status: status,
                                    id: rowId,
                                    qtyDelivered: qtyDelivered,
                                    pid: pidValue // Add pid from pIds at the same index
                                };

                                productList.push(productData);
                            });

                            // Now productList contains both productData and pid values for each row


                            // console.log(productList);

                            var jsonData = JSON.stringify(poListsArrForm);

                            $.ajax({
                                type: "post",
                                url: "database/update_order.php",
                                data: {
                                    productList: JSON.stringify(productList)
                                },
                                success: function(response) {
                                    // console.log(response);
                                    $('#exampleModal').modal('hide');
                                    // alert(response);
                                    location.reload();
                                }
                            });
                        })
                    })
                }

                if (classList.contains('deliveryBtn')) {
                    let id = targetElement.dataset.id;

                    // console.log(id);

                    $.get('database/delivery_history.php', {
                        id: id
                    }, function(data) {
                        if (data.length > 0) {
                            const $historyModal = $('.history_modal');

                            // Clear the existing content of the modal
                            $historyModal.empty();
                            rows = '';
                            data.forEach((row, id) => {
                                receivedDate = new Date(row['date_received']);
                                rows += '\
                                    <tr>\
                                        <td>' + (id + 1) + '</td>\
                                        <td>' + receivedDate.toUTCString() + '</td>\
                                        <td>' + row['qty_received'] + '</td>\
                                '
                            });
                            history_modal_body = '<table class="history_modal_body">\
                            <thead>\
                                <tr>\
                                    <th>#</th>\
                                    <th>date received</th>\
                                    <th>qty received</th>\
                                </tr>\
                            </thead>\
                                <tbody>' + rows + '</tbody>\
                            '
                            $historyModal.append(history_modal_body);
                            // console.log(data);
                        } else {
                            // alert('No delivery records found');
                        }
                    }, 'json');
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
<script>

</script>


</html>