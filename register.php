

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
                                                <button type="submit" class="appBtn"><i class="fa fa-plus"></i> register</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>

        </div>
    </div>
</body>

</html>