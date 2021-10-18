<?php
    use app\core\Application;
    use app\core\Session;

    $this->title = 'cart';

    // echo '<pre>';
    // var_dump($cart->getItems());
    // echo '</pre>';

    $items = $cart->getItems();

    // foreach($items as $item){
    //     echo '<pre>';
    //     var_dump($item->itemSummary());
    //     echo '</pre>';
        
    // }

?>


<main>
<div class="container">
        <div class="row">
            <div class="col-12 col-md-8 col-lg-8">
                <div class="d-flex justify-content-between cart-header">
                    <h4>YOUR CART</h4>
                    <div>
                        <span>Subtotal</span>
                        <span>$154.00</span>
                        <a href="#">Check Out</a>
                    </div>
                </div>
        
                <div class="cart-body">
                    <?php foreach($items as $item) : ?>
                        <div class="cart-items d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center col-5">
                                <img src="/asset/img/<?= $item->itemSummary()['img'] ?>" alt="" width="120px">
                                <div class="added-item-details">
                                    <p><?= $item->itemSummary()['title'] ?></p>
                                    <span><?= $item->itemSummary()['price'] ?></span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center d-flex justify-content-between col-3">
                                <div class="quantity">
                                    <img src="/asset/img/minus.jpg" alt="" srcset="" width="16px">
                                        <span><?= $item->itemSummary()['quantity'] ?></span>
                                    <img src="/asset/img/plus.jpg" alt="" srcset="" width="16px">
                                </div>
                                <div class="total d-flex align-items-center">
                                    <span><?= $item->itemSummary()['price'] * $item->itemSummary()['quantity'] ?></span>
                                    <img src="/asset/img/cancel.png" alt="" srcset="" width="20px">
                                </div>
                            </div>
                        </div> 
                    <?php endforeach ; ?>
              
       
                    <!-- <div class="cart-items d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center col-5">
                            <img src="../assests/images/male/0023329_traditional-short-sleeve-dress-shirt_360.jpeg" alt="" width="120px">
                            <div class="added-item-details">
                                <p>traditional short sleeve dress shirt</p>
                                <span>$56.00</span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center d-flex justify-content-between col-3">
                          
                            <div class="quantity">
                               
                                <img src="../assests/images/minus.jpg" alt="" srcset="" width="16px">
                                    <span>1</span>
                                <img src="../assests/images/plus.jpg" alt="" srcset="" width="16px">
                            </div>
                            <div class="total d-flex align-items-center">
                                <span>$159.00</span>
                                <img src="../assests/images/close.jpg" alt="" srcset="" width="20px">
                            </div>
                        </div>
                    </div>  -->
                    
<!--         
                     <div class="cart-items d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center col-5">
                            <img src="../assests/images/male/0023329_traditional-short-sleeve-dress-shirt_360.jpeg" alt="" width="120px">
                            <div class="added-item-details">
                                <p>traditional short sleeve dress shirt</p>
                                <span>$56.00</span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center d-flex justify-content-between col-3">
                   
                            <div class="quantity">
                               
                                <img src="../assests/images/minus.jpg" alt="" srcset="" width="16px">
                                    <span>1</span>
                                <img src="../assests/images/plus.jpg" alt="" srcset="" width="16px">
                            </div>
                            <div class="total d-flex align-items-center">
                                <span>$159.00</span>
                                <img src="../assests/images/close.jpg" alt="" srcset="" width="20px">
                            </div>
                        </div>
                    </div> -->
                </div> 
        
            </div>
            <div class="col-12 col-md-4 col-lg-4">
                
                <div class="cart-footer mt-4">
                    <div class="d-flex justify-content-between ">
                        <div>
                            <h4>Subtotal</h4>
                            <p>Shipping & taxes calculated at Checkout</p>
                            <a href="#">Calculate Shipping</a>
                        </div>
                        <div>
                            <span>$332.00</span>
                        </div>
                    </div>
                 
                    <div class="mt-4">
                        <a href="/checkout" class="checkout">Check Out</a>
                        <a href="/order" class="shop">Continue ordering</a>
                    </div>
                </div>
            </div>
        </div>
</div>
</main>
