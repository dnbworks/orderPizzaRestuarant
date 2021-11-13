<nav>
        <div class="container-fluid logo-menu-container">
            <a href="/" class="logo">
                <img src="asset/img/logopizzas.png" alt="" srcset="">
            </a>
    
            <div class="row align-items-center justify-content-end">
                <div class="col-3 d-flex justify-content-end">
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
                        <a href="/account" class="account" style="display: inline-block;">
                            <img src="asset/img/account.png" alt="" srcset="" width="24px">
                        </a>
                            
                        <div class="cartBtn-div">
                            <img src="asset/img/cart.png" alt="" srcset="">
                            <span class="amount"><?= $_SESSION['cart']->getTotalQuantity() ?></span>
                        </div>
                    </div>
                    <?php
                        include_once dirname(__DIR__). "/partials/navmenu.php";
                    ?>  
    
    
                </div>
            </div>
            <div class="cart">
                <div class="d-flex justify-content-between py-2">
                    <span class="clearbtn">CLEAR CART</span>
                    <img src="asset/img/cancel.png" alt="" srcset="" width="20px" height="20px">
                </div>
                <p class="py-2">Your cart is empty</p> 
                <?php foreach($_SESSION['cart'] as $item) : ?>
                    <div>
                        item
                    </div>
                <?php endforeach ; ?>
                <div class="d-flex justify-content-between py-2">
                  <span>Total</span>
                  <span>Php 0.00</span>      
                </div>
                <a href="/checkout">CHECKOUT</a>
            </div>
        </div>
    </nav>