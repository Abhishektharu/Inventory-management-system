<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/home-page.css">
    <link rel="stylesheet" href="css/contactusform.css">
    <link rel="shortcut icon" type="x-icon" href="Vector.svg">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>homepage</title>
</head>
<body>
    <header>
        <img class="logo" src="logo.svg" alt="logo">
        <nav>
            <ul class="nav_links">
                <!-- <li><a href="#">services</a></li>
                <li><a href="#">services</a></li>
                <li><a href="#">services</a></li> -->
            </ul>
        </nav>
        <a href="login.php" class="login"><button>Login</button></a>
    </header>

    <div class="section">
        <div class="text">
            <div style="margin-top: 80px;">
                <h1 style="font-size: 50px;">IMS</h1>
                
                <p>inventory management system <br> <br>
                    An inventory management system is a software application or tool that helps businesses effectively track, control, and manage their inventory. It provides a centralized platform to monitor inventory levels, track stock movement, and streamline various inventory-related processes.
                </p>

                <div class="contact_btn" >
                    <button type="button" onclick="openPopup()">Contact</button>
                </div>

                <div class="social_icons">
                    <a href="#">
                        <i class='bx bxl-facebook-square'></i>
                    </a>
                    <a href="#">
                        <i class='bx bxl-instagram-alt'></i>
                    </a>
                    <a href="#">
                        <i class='bx bxl-twitter' ></i>
                    </a>
                    <a href="#">
                        <i class='bx bxl-whatsapp-square' ></i>
                    </a>
                    
                </div>
            </div>
            <img src="ims.png" alt="inventory" /> 
            <!-- style="mix-blend-mode: color-burn;" -->
        </div>

        <!-- contact us form  -->
        <div class="popup" id="popUp"> 
            <div class="container">
                <div class="content">
                    <!-- left side -->
                    <div class="left-side">
    
                        <div class="address">
                            <i class='bx bxs-map'></i>
                            <div class="topic">Address</div>
                            <div class="text-one">Kathmandu,</div>
                            <div class="text-two">Nepal</div>
                        </div>
                        <hr>
    
                        <div class="phone">
                            <i class='bx bxs-phone' ></i>
                            <div class="topic">Phone</div>
                            <div class="text-one">+977 123-4567890</div>
                            <div class="text-two">01-4110000</div>
                        </div>
                        <hr>

                        <div class="email">
                            <i class='bx bxs-envelope' ></i>
                            <div class="topic">Email:</div>
                            <div class="text-one">inventory.management@email.com</div>
                            <div class="text-two">ims@email.com</div>
                        </div>
                    </div>
    
                    <!-- right side -->
                    <div class="right-side">
                        <div class="topic-text">Contact Us</div>
                        <form action="" method="">
                            <div class="input-box">
                                <input type="text" name="name" placeholder="Enter your name">
                            </div>
    
                            <div class="input-box">
                                <input type="email" name="email" placeholder="Enter your email">
                            </div>
    
                            <div class="input-box message-box">
                                <textarea name="message" cols="30" rows="10" placeholder="Enter your message"></textarea>
                            </div>
    
                            <div class="button">
                                <input type="button" value="send">
                            </div>

                            <div class="button">
                                <input type="button" value="close" onclick="closePopup()">
                            </div>
    
                        </form>
                    </div>
                </div>
            </div>
        </div> 

    </div>

    <!-- script for popup -->
    <script>
        let popup = document.getElementById("popUp");

        function openPopup(){
            popup.classList.add("open-popup");
        }

        function closePopup(){
            popup.classList.remove("open-popup");
        }
    </script>

</body>
</html>