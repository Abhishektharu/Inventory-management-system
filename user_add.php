<?php
//start the session.
session_start();

if (!isset($_SESSION['user'])) header('Location: homepage.php');
$_SESSION['table'] = 'users';
$_SESSION['redirect_to'] = 'user_add.php';


// $user = $_SESSION['user'];
$show_table = 'users';

$users = include('database/show.php');
// var_dump($users);
$response_message = '';
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
                                    user_id: userId,
                                    f_name: fname,
                                    l_name: lname
                                },
                                url: 'database/delete_user.php',
                                dataType: 'json',
                                success: function(data){
                                    //from delete_user success = true;
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

    }

    var script = new script;
    script.initilize();
</script>

</html>