<?php
    $user = $_SESSION['user'];
?>

<div class="sidebar" id="navbar">

    <!--profile image & text-->
    <div class="profile">
        <!-- <img src="unnamed1.png" alt="profile_picture"> -->
        
        <h3>User : <?= $user['first_name']?></h3>
        
    </div>

    <!--menu item-->
    <ul>
        
        <li>
            <a href="dashboard.php" class="btn">
                <span class="icon"><i class="fas fa-desktop"></i></span>
                <span class="item">My Dashboard</span>
            </a>
        </li>


        <li class="liMainMenu showHideSubMenu" >
            <a href="javascript:void(0);" class="showHideSubMenu" >
                <span class="icon"><i class="fas fa-tag showHideSubMenu" ></i></span>
                <span class="showHideSubMenu"  >Product</span>
                <i class="fa fa-angle-down mainMenuIconArrow showHideSubMenu" ></i>
            </a>

            <!-- subMenus css is written in user_add2.css -->
            <ul class="subMenus" >
                <li><a class="subMenuLink" href="./product_view.php"><i class="fa fa-circle"></i> View Product</a></li>
                <li><a class="subMenuLink" href="./product_add.php"><i class="fa fa-circle"></i> Add Product</a></li>
            </ul>
        </li>

        <li class="liMainMenu showHideSubMenu" >
            <a href="javascript:void(0);" class="showHideSubMenu" >
                <span class="icon"><i class="fas fa-truck showHideSubMenu" ></i></span>
                <span class="showHideSubMenu" >Supplier</span>
                <i class="fa fa-angle-down mainMenuIconArrow showHideSubMenu" ></i>
            </a>

            <!-- subMenus css is written in user_add2.css -->
            <ul class="subMenus" >
                <li><a class="subMenuLink" href="./supplier_view.php"><i class="fa fa-circle"></i> View Supplier</a></li>
                <li><a class="subMenuLink" href="./supplier_add.php"><i class="fa fa-circle"></i> Add Supplier</a></li>
            </ul>
        </li>

        <li class="liMainMenu showHideSubMenu" >
            <a href="javascript:void(0);" class="showHideSubMenu" >
                <span class="icon"><i class="fas fa-shopping-cart showHideSubMenu" ></i></span>
                <span class="showHideSubMenu" >Order</span>
                <i class="fa fa-angle-down mainMenuIconArrow showHideSubMenu" ></i>
            </a>

            <!-- subMenus css is written in user_add2.css -->
            <ul class="subMenus" >
                <li><a class="subMenuLink" href="./view_order.php"><i class="fa fa-circle"></i> View orders</a></li>
                <li><a class="subMenuLink" href="./product_order.php"><i class="fa fa-circle"></i> Add orders</a></li>
            </ul>
        </li>

        <li class="liMainMenu showHideSubMenu" >
            <a href="javascript:void(0);" class="showHideSubMenu" >
                <span class="icon"><i class="fas fa-user-friends showHideSubMenu" ></i></span>
                <span class="showHideSubMenu"  >User</span>
                <i class="fa fa-angle-down mainMenuIconArrow showHideSubMenu" ></i>
            </a>

            <!-- subMenus css is written in user_add2.css -->
            <ul class="subMenus" >
                <li><a class="subMenuLink" href="./user_view.php"><i class="fa fa-circle"></i> View Users</a></li>
                <li><a class="subMenuLink" href="./user_add.php"><i class="fa fa-circle"></i> Add Users</a></li>
            </ul>
        </li>


    </ul>
</div>

<script>
    var btnContainer = document.getElementById("navbar");
    var btns = btnContainer.getElementByClassName("btn");

    for(var i = 0; i < btns.length; i++){
        btns[i].addEventlistener('click', function(){
            var current = document.getElementByClassName("active");
            current[0].className = current[0].className.replace("active");
            this.className += "active";
        });
    }
</script>