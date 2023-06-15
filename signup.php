<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/forms.css">
    <title>Sign up</title>
</head>
<body>
    <div class="content">
        <div class="image-box">
            <img src="ims.png" alt="Image">
        </div>

        <div class="form-field">
            <div class="text">Sign Up</div>

            <form action="" method="post">

                <div class="input">
                    <label for="name">Full Name</label>
                    <input type="text" name="name" placeholder="Full Name">
                </div>

                <div class="input">
                    <label for="email">Email</label>
                    <input type="text" name="email" placeholder="email" required >
                </div>

                <div class="input">
                    <label for="password">Password</label>
                    <input type="password" name="password" placeholder="password">
                </div>

                <div class="button">
                    <button type="submit" name="submit" class="btn">Sign Up</button>
                </div>

                <div class="logging">
                    <p>Have an account?</p><a href="login.php">Log In</a>     
               </div>

               <div class="back-signup">
                   <a href="homepage.php" class="hover-back-signup"> BACK</a>
               </div>

            </form>
        </div>

    </div>
</body>
</html>