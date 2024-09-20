<?php
session_start();
require 'db_connection.php';  // Include your database connection

$suppliers = [];

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $sortBy = isset($_GET['sort_by']) ? $_GET['sort_by'] : 'supplier_name';
    $order = isset($_GET['order']) ? $_GET['order'] : 'ASC';  // Default order is ascending

    // Prepare SQL query with sorting
    $sql = "SELECT * FROM suppliers ORDER BY $sortBy $order";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    
    // Fetch all suppliers
    $suppliers = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
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
    <link rel="stylesheet" href="css/sidebar.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <link rel="stylesheet" href="css/user_add2.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: #fff;
        }
        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background: #f2f2f2;
        }
        tr:hover {
            background: #f9f9f9;
        }
        button {
            background: #007bff;
            color: #fff;
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin: 0 5px;
        }
        button:hover {
            background: #0056b3;
        }
    </style>


</head>

<body>

    <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Users</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="database/updateuser.php" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="update_id" id="update_id">
                        <div class="form-group">
                            <label>Supplier Name</label>
                            <input type="text" class="form-control" name="fname" id="edit_Sname" placeholder="Enter supplier name">
                        </div>


                        <div class="form-group">
                            <label>Supplier Location</label>
                            <input type="text" class="form-control" name="lname" id="edit_Location" placeholder="Enter supplier location">
                        </div>


                        <div class="form-group">
                            <label>email</label>
                            <input type="email" class="form-control" name="email" id="edit_email" placeholder="Enter email">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="updatedata" class="btn btn-primary supplier_update_ajax ">save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- dashboardMainContainer -->
    <div class="wrapper">


        <!--Top menu -->
        <div class="section">
            <?php
            include('partials/top_nav.php');
            ?>


            <!-- container main -->
            <div class="containerMain">

            <h2>List Suppliers</h2>

<table>
    <tr>
        <th>
            Supplier Name
            <a href="?sort_by=supplier_name&order=ASC"><button>↑</button></a>
            <a href="?sort_by=supplier_name&order=DESC"><button>↓</button></a>
        </th>
        <th>
            Location
            <a href="?sort_by=supplier_location&order=ASC"><button>↑</button></a>
            <a href="?sort_by=supplier_location&order=DESC"><button>↓</button></a>
        </th>
        <th>
            Email
            <a href="?sort_by=email&order=ASC"><button>↑</button></a>
            <a href="?sort_by=email&order=DESC"><button>↓</button></a>
        </th>
        <th>
            Created At
            <a href="?sort_by=created_at&order=ASC"><button>↑</button></a>
            <a href="?sort_by=created_at&order=DESC"><button>↓</button></a>
        </th>
    </tr>
    <?php foreach ($suppliers as $supplier): ?>
    <tr>
        <td><?php echo htmlspecialchars($supplier['supplier_name']); ?></td>
        <td><?php echo htmlspecialchars($supplier['supplier_location']); ?></td>
        <td><?php echo htmlspecialchars($supplier['email']); ?></td>
        <td><?php echo htmlspecialchars($supplier['created_at']); ?></td>
    </tr>
    <?php endforeach; ?>
</table>



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
                if (classList.contains('updateUser')) {
                    e.preventDefault();
                    userId = targetElement.dataset.sid;
                    // firstName = targetElement.closest('tr').querySelector('td.firstName').innerHTML;
                    // lastName = targetElement.closest('tr').querySelector('td.lastName').innerHTML;
                    // email = targetElement.closest('tr').querySelector('td.email').innerHTML;
                    // console.log(userId, firstName, lastName, email);
                    console.log(userId);

                    $('.supplier_update_ajax').click(function(e) { //called from save button from modal
                        e.preventDefault();

                        var uId = userId;
                        // var fname = firstName
                        // var lname = lastName
                        // var u_email = email
                        var supplier_name = $('#edit_Sname').val();
                        var supplier_location = $('#edit_Location').val();
                        var email = $('#edit_email').val();
                        if (email != '', supplier_name != '' & supplier_location != '') {
                            $.ajax({
                                type: 'POST',
                                url: "database/updateuser.php",
                                data: {
                                    'checking_supplier': true,
                                    'uId': uId,
                                    'supplier_name': supplier_name,
                                    'supplier_location': supplier_location,
                                    'email': email,
                                },
                                success: function(response) {
                                    $('#editmodal').modal('hide');
                                    location.reload();
                                    // console.log(response);
                                }
                            });
                        } else {
                            console.log("Please enter all fileds.");
                        }

                    });
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        $('.editbtn').on('click', function() {
            $('#editmodal').modal('show');
            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();

            console.log(data);

            $('#update_id').val(data[0]);
            $('#edit_Sname').val(data[1]);
            $('#edit_Location').val(data[2]);
            $('#edit_email').val(data[3]);
        });

    });
</script>

</html>