<?php
    use app\core\Application;
    use app\core\Session;
    use app\helpers\PriceHelper;

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
                        <span>Subtotal: </span>
                        <span class="subtotal">PHP <?= app\helpers\PriceHelper::formatMoney($cart->getTotalSum()) ?></span>
                        <!-- <a href="#">Check Out</a> -->
                    </div>
                </div>
         
                <div class="cart-body">
                    <div class="empty-cart-notification"></div>
                    <?php if($_SESSION['cart']->getTotalQuantity() == 0) : ?>
                        <div class="empty-cart">
                            <p>Your cart is currenly empty. It seems the right time to start ordering</p>
                            <a href="/order">Order here</a>
                        </div>
                    <?php endif ?>
                    
                    <div class="pre-loader">
                        <img src="asset/img/loader.svg" alt="" srcset="" width="20px">
                    </div>
                    <?php foreach($items as $id => $item) : ?>
                        <!-- <?= $key ?> -->
                        <div class="cart-items d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center col-9 col-md-6" style="padding-left: 5px !important;">
                                <img src="/asset/img/<?= $item->itemSummary()['img'] ?>" alt="" width="100px" class="pic">
                                <div class="added-item-details">
                                    <a href="/order"><?= $item->itemSummary()['title'] ?></a>
                                    <span>PHP <?= app\helpers\PriceHelper::formatMoney((float)$item->itemSummary()['price']) ?> X (<?= $item->itemSummary()['quantity'] ?>)</span>
                                    <span>Total: PHP <?= app\helpers\PriceHelper::formatMoney((float)$item->itemSummary()['price'] * (int)$item->itemSummary()['quantity']) ?></span>
                                    <span>Addons</span>
                                    <div class="addons">
                                        <?php foreach($item->itemSummary()['options'] as $key => $option): ?>
                                            <span><b><?= $key ?></b>: <?= $option ?></span>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center d-flex justify-content-between col-3">
                                <a href="/edit?id=<?= $id ?>&name=<?= $item->itemSummary()['title'] ?>" id="<?= $item->itemSummary()['id'] ?>">Edit</a>
                                <div class="total d-flex align-items-center">
                                    <img src="/asset/img/cancel.png" alt="" srcset="" width="15px" id="<?= $id ?>" class="delete">
                                </div>
                            </div>
                        </div> 
                    <?php endforeach ; ?>
            
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
                        <span class="subtotal">PHP <?= app\helpers\PriceHelper::formatMoney($cart->getTotalSum()) ?></span>
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
