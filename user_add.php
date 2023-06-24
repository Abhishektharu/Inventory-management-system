<?php
//start the session.
session_start();

if (!isset($_SESSION['user'])) header('Location: homepage.php');
$_SESSION['table'] = 'users';

$user = $_SESSION['user'];
$response_message = '';

$users = include('show_users.php');
// var_dump($users);
// die;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Manangement System</title>
    <link rel="stylesheet" href="css/user_add.css">
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
                                    <div class="column-5">
                                        <h1 class="section_header"><i class="fa fa-plus"></i> Create User</h1>
                                        <div id="userAddFormContainer">
                                            <form action="add.php" method="POST" class="appForm">
                                                <div class="appFormInputContainer">
                                                    <label for="first_name">First Name</label>
                                                    <input type="text" id="first_name" name="first_name" class="appFormInput" required/>
                                                </div>

                                                <div class="appFormInputContainer">
                                                    <label for="last_name">Last Name</label>
                                                    <input type="text" id="last_name" name="last_name" class="appFormInput" required/>
                                                </div>

                                                <div class="appFormInputContainer">
                                                    <label for="email">email</label>
                                                    <input type="text" id="email" name="email" class="appFormInput" required/>
                                                </div>

                                                <div class="appFormInputContainer">
                                                    <label for="password">password</label>
                                                    <input type="password" id="password" name="password" class="appFormInput" required/>
                                                </div>

                                                <input type="hidden" name="table" value="users" />
                                                <button type="submit" class="appBtn"><i class="fa fa-plus"></i> Add User</button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="column-7">
                                        <h1 class="section_header"><i class="fa fa-list"></i> List of Users</h1>
                                        <div class="section_content">
                                            <div class="users">
                                                <table>
                                                    <thead>

                                                        <tr>
                                                            <th>nu</th>
                                                            <th>First Name</th>
                                                            <th>Last Name</th>
                                                            <th>Email</th>
                                                            <th>Created At</th>
                                                            <th>Upadated At</th>
                                                            <th>Option</th>
                                                        </tr>
                                                    </thead>

                                                    <!-- table body of add users  -->
                                                    <tbody>
                                                        <?php foreach ($users as $index => $user) {
                                                        ?>
                                                            <tr>
                                                                <td><?= $index + 1 ?></td>
                                                                <td><?= $user['first_name'] ?></td>
                                                                <td><?= $user['last_name'] ?></td>
                                                                <td><?= $user['email'] ?></td>
                                                                <!-- set month day year using php  -->
                                                                <td><?= date('M d, Y @ h:i:s A', strtotime($user['created_at'])) ?></td>
                                                                <td><?= date('M d, Y @ h:i:s A', strtotime($user['updated_at'])) ?></td>


                                                                <!-- adding edit and delete option` -->
                                                                <td>
                                                                    <!-- <a href=""><i class="fa fa-pencil"></i>Edit</a> -->

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
                    classList = e.target.classList;

                    if (classList.contains('deleteUser')) {
                        e.preventDefault();
                        userId = targetElement.dataset.userid;
                        fname = targetElement.dataset.fname;
                        lname = targetElement.dataset.lname;
                        fullName = fname + " " + lname;

                        if (window.confirm('Are you sure to delete? ' + fullName)) {
                            $.ajax({
                                method: 'POST',
                                data: {
                                    user_id: userId,
                                    f_name: fname,
                                    l_name: lname
                                },
                                url: 'database/delete_user.php',
                                dataType: 'json',
                                success: function(data){
                                    //from delete_user success = true;
                                    if(data.success){
                                        if(window.alert(data.message)){
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

    }

    var script = new script;
    script.initilize();
</script>

</html>

<!-- table create
insert data
use joins

update schemas -->