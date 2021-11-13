<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pizza</title>

    
    <link rel="stylesheet" href="asset/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="asset/css/styles.css">
    <link rel="stylesheet" href="asset/css/global.css">
    <link rel="stylesheet" href="asset/css/slick.css">
    <link rel="stylesheet" href="asset/css/slick-theme.css">
    <link rel="shortcut icon" href="asset/imgs/logo.png" type="image/png">

    <script src="asset/js/script.js" defer ></script>
    <script src="asset/js/global.js" defer></script>



    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&family=Yaldevi:wght@200&display=swap" rel="stylesheet">

    <script src='https://api.mapbox.com/mapbox-gl-js/v2.1.1/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.1.1/mapbox-gl.css' rel='stylesheet' />

</head>
<body>
    <nav>
        <div class="container-fluid logo-menu-container">
            <a href="/" class="logo">
                <img src="asset/img/logopizzas.png" alt="" srcset="">
            </a>
            
            <div class="row align-items-center justify-content-end">
                <div class="col-3 d-flex justify-content-end align-items-center ">
                    <!-- <a href="/login" class="account" style="display: inline-block;">
                        <img src="asset/img/account.png" alt="" srcset="" width="24px">
                    </a>
                        
                    <div class="cartBtn-div">
                        <img src="asset/img/cart.png" alt="" srcset="">
                        <span class="amount"><?= $_SESSION['cart']->getTotalQuantity() ?></span>
                    </div> -->
                    <div class="menu-container">
                        <div class="menu">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>   
                 </div>
                 <div class="col-9 nav-container">
                     <div class="top-section">
                        <div class="search-container">
                            <form action="" method="post">
                                <input type="text" name="search" placeholder="what are you looking for..."> 
                            </form>
                            <span><i class="fas fa-search"></i></span>
                            <span>search</span>
                         </div>
                         <ul class="social-media">
                             <li><span><i class="fab fa-facebook-f"></i></span></li>
                             <li><span><i class="fab fa-twitter"></i></span></li>
                             <li><span><i class=" fab fa-instagram"></i></span></li>
                         </ul>
                         <a href="/login" class="account" style="display: inline-block;">
                            <img src="asset/img/account.png" alt="" srcset="" width="24px">
                        </a>
                         <div class="cartBtn-div">
                            <img src="asset/img/cart.png" alt="" srcset="" class="cartBtn">
                            <span class="amount"><?= $_SESSION['cart']->getTotalQuantity() ?></span>
                        </div>
                     </div>
                     <div class="links-contianer">
                        <ul class="links">
                            <li><a href="/" class="active-link">Home</a></li>
                            <li><a href="/order">Order Online</a></li>
                            <li><a href="menu.html">Menu</a></li>
                            <li><a href="store.html">Store</a></li>
                            <li><a href="store.html">Career</a></li>
                            <li><a href="about.html">About us</a></li>
                        </ul>
                     </div>
                     
                    
                 </div>
            </div>
            <div class="cart">
                <div class="d-flex justify-content-between py-2">
                    <span class="clearbtn">CLEAR CART</span>
                    <img src="asset/img/cancel.png" alt="" srcset="" width="20px" height="20px">
                </div>
                <p class="py-2">Your cart is empty</p> 
                <div class="d-flex justify-content-between py-2">
                  <span>Total</span>
                  <span>Php 0.00</span>      
                </div>
                <a href="/checkout">CHECKOUT</a>
            </div>
        </div>
    </nav>

    {{content}}

   
    <?php
        include_once dirname(__DIR__). "/partials/footer.php";
        include_once dirname(__DIR__). "/partials/sidenav.php";
    ?>  

    <script src="asset/js/jquery.min.js"></script>
    <script src="asset/js/slick.js"></script>
    <script src="asset/js/font_awesome.js"></script>


</body>
</html>