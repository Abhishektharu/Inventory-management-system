<?php
session_start();

if (isset($_SESSION['user'])) header('Location: dashboard.php');
$error_message = '';
if ($_POST) {
    include('connection.php');

    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = 'SELECT * FROM users WHERE users.email="' . $email . '" AND users.password="' . $password . '"';

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        // Password is correct; set the user session
        $_SESSION['user'] = $user;
        header('Location: dashboard.php');
        exit;
    } else {
        $error_message = 'Please enter correct email or password.';
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>IMS Login - Inventory Management System</title>
    <link rel="stylesheet" type="text/css" href="css/forms.css">
    <link rel="shortcut icon" type="x-icon" href="Vector.svg">
    <style>
        div#errorMessage {
            background-color: #fff;
            text-align: center;
            color: red;
            font-size: 20px;
            padding: 11px;
        }
    </style>
</head>

<body id="loginBody">
    <?php
    if (!empty($error_message)) {
    ?>
        <div id="errorMessage">
            <p>Error: <?= $error_message ?></p>
        </div>
    <?php }

    ?>
    <div class="content">
        <div class="image-box">
            <img src="ims.png" alt="Image">
        </div>

        <div class="form-field">
            <div class="text">Login</div>
            <form action="login.php" method="post">
                <div class="input">
                    <label for="email">email</label>
                    <input type="text" name="email" placeholder="email" required>
                </div>

                <div class="input">
                    <label for="password">Password</label>
                    <input type="password" name="password" placeholder="password">
                </div>

                <div class="login">
                    <button type="submit" class="btn" name="login">Login</button>
                </div>

                <div class="back-login">
                    <a href="homepage.php" class="hover-back-login"> BACK</a>
                </div>

            </form>

        </div>

    </div>
</body>

</html>