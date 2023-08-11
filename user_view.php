<?php
//start the session.
session_start();

if (!isset($_SESSION['user'])) header('Location: homepage.php');
$_SESSION['table'] = 'users';
$user = $_SESSION['user'];

$show_table = 'users';

// session of products
$_SESSION['table'] = 'users';
$users = include('database/show.php');

$response_message = '';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Manangement System</title>
    <link rel="stylesheet" href="css/user_add.css">
    <link rel="shortcut icon" type="x-icon" href="Vector.svg">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <link rel="stylesheet" href="css/user_add2.css">
    <link rel="stylesheet" href="css/supplier.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">


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
                                        <h1 class="section_header"><i class="fa fa-list"></i> List of Users</h1>
                                        <div class="section_content">
                                            <div class="users">

                                                <!-- ########################################################################################################## -->
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
                                                                        <label>First Name</label>
                                                                        <input type="text" class="form-control" name="fname" id="edit_fname" placeholder="Enter first name">
                                                                    </div>


                                                                    <div class="form-group">
                                                                        <label>Last Name</label>
                                                                        <input type="text" class="form-control" name="lname" id="edit_lname" placeholder="Enter Last name">
                                                                    </div>


                                                                    <div class="form-group">
                                                                        <label>email</label>
                                                                        <input type="email" class="form-control" name="email" id="edit_email" placeholder="Enter email">
                                                                    </div>

                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                    <button type="submit" name="updatedata" class="btn btn-primary user_update_ajax ">save</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- ########################################################################################################## -->

                                                <table>
                                                    <thead>
                                                        <tr>
                                                            <th>nu</th>
                                                            <th>First Name</th>
                                                            <th>Last Name</th>
                                                            <th>Email</th>
                                                            <th>Created At</th>
                                                            <th>Updated At</th>
                                                            <th>Option</th>
                                                        </tr>
                                                    </thead>

                                                    <!-- table body of add users  -->
                                                    <tbody>
                                                        <?php foreach ($users as $index => $user) {
                                                        ?>
                                                            <tr>
                                                                <td><?= $index + 1; ?></td>
                                                                <td class="firstName"><?= $user['first_name'] ?></td>
                                                                <td class="lastName"><?= $user['last_name'] ?></td>
                                                                <td class="email"><?= $user['email'] ?></td>
                                                                <!-- set month day year using php  -->
                                                                <td><?= date('M d, Y @ h:i:s A', strtotime($user['created_at'])) ?></td>
                                                                <td><?= date('M d, Y @ h:i:s A', strtotime($user['updated_at'])) ?></td>


                                                                <!-- adding edit and delete option` -->
                                                                <td>

                                                                    <!-- <a href="" class="updateUser"><i class="fa fa-pencil"></i>Edit</a> -->
                                                                    <button type="button" data-userid="<?= $user['id'] ?>" class="btn btn-success updateUser editbtn">edit</button>

                                                                    <a href="" class="deleteUser" data-userid="<?= $user['id'] ?>" data-fname="<?= $user['first_name'] ?>" data-lname="<?= $user['last_name'] ?>"> <i class="fa fa-trash"></i>Delete</a>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                                <p class="userCount"><?= count($users) ?> Users </p>
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
    function script() {
        this.initilize = function() {
                this.registerEvents();
            },

            this.registerEvents = function() {
                document.addEventListener('click', function(e) {
                    targetElement = e.target;
                    classList = targetElement.classList;

                    if (classList.contains('deleteUser')) {
                        e.preventDefault();
                        userId = targetElement.dataset.userid;
                        fname = targetElement.dataset.fname;
                        lname = targetElement.dataset.lname;
                        fullName = fname + ' ' + lname;

                        if (window.confirm('Are you sure to delete ? ' + fullName)) {
                            $.ajax({
                                method: 'POST',
                                data: {
                                    id: userId,
                                    table: 'users'
                                },
                                url: 'database/delete.php',
                                dataType: 'json',
                                success: function(data) {
                                    //from delete_user success = true;
                                    json_decode('data');
                                    if (data.success === 'true') {
                                            location.reload();
                                        
                                    } else window.alert(data.message);
                                }
                            })
                        } else {
                            console.log("not delete");
                        }
                    }

                    if (classList.contains('updateUser')) {
                        e.preventDefault();
                        userId = targetElement.dataset.userid;
                        // firstName = targetElement.closest('tr').querySelector('td.firstName').innerHTML;
                        // lastName = targetElement.closest('tr').querySelector('td.lastName').innerHTML;
                        // email = targetElement.closest('tr').querySelector('td.email').innerHTML;
                        // console.log(userId, firstName, lastName, email);
                        console.log(userId);

                        $('.user_update_ajax').click(function(e) { //called from save button from modal
                            e.preventDefault();

                            var uId = userId
                            // var fname = firstName
                            // var lname = lastName
                            // var u_email = email
                            var fname = $('#edit_fname').val();
                            var lname = $('#edit_lname').val();
                            var email = $('#edit_email').val();
                            if ( email != '', fname != '' & lname != '') {
                                $.ajax({
                                    type: 'POST',
                                    url: "database/updateuser.php",
                                    data: {
                                        'checking_update': true,
                                        'uId': uId,
                                        'fname': fname,
                                        'lname': lname,
                                        'email': email,
                                    },
                                    success: function(response) {
                                        $('#editmodal').modal('hide');
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

    }

    var script = new script;
    script.initilize();
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
            $('#edit_fname').val(data[1]);
            $('#edit_lname').val(data[2]);
            $('#edit_email').val(data[3]);
        });

    });
</script>

</html>

<!-- table create
insert data
use joins

update schemas -->