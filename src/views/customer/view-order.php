<?php
    $this->title = 'View-order';
?>

<?php
    // foreach($orders as $order){
    //     echo $order['title'] . '<br>';
    //     echo $order['subtotal'] . '<br>';
    //     echo $order['quantity'] . '<br>';
    // }
        // echo '<pre>';
        // var_dump($orders);
        // echo '</pre>';
    ?>
<div class="woocommerce-MyAccount-content container my-5 py-2">
    <div class="container">
        <div class="row">
            <div class="col-3">
                <?php require 'partials/sidenav.php'; ?>
            </div>
            <div class="col-8">
                <div class="woocommerce-notices-wrapper"></div>
                <p class="entry-content">Order #<mark class="order-number"><?= $orders[0]['order_id'] ?></mark> was placed on <mark class="order-date">October 28, 2021</mark> and is currently <mark class="order-status">Processing</mark>.</p>
                <section class="woocommerce-order-details">
	                <h2 class="woocommerce-order-details__title">Order details</h2>

                    <table class="table order_details">

                        <thead>
                            <tr>
                                <th class="woocommerce-table__product-name product-name">Product</th>
                                <th class="woocommerce-table__product-table product-total">Total</th>
                            </tr>
                        </thead>

                        <tbody>
                        <?php foreach($orders as $order): ?>
                            <tr class="woocommerce-table__line-item order_item">
                                <td class="woocommerce-table__product-name product-name">
                                    <a href="http://localhost/wordpress/product/gig-shorts/"><?= $order['title'] ?></a> <strong class="product-quantity">×&nbsp;<?= $order['quantity'] ?></strong>	
                                </td>
                                <td class="woocommerce-table__product-total product-total">
                                    <span class="woocommerce-Price-amount"><bdi><span class="woocommerce-Price-currencySymbol">PHP </span><?= $order['subtotal'] ?></bdi></span>	
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>

                        <tfoot>
                            <tr>
                                <th scope="row">Subtotal:</th>
                                <td><span class="woocommerce-Price-amount"><span class="woocommerce-Price-currencySymbol">PHP </span><?= $orders[0]['total'] ?></span></td>
                            </tr>
                            <tr>
                                <th scope="row">Payment method:</th>
                                <td>Cash on delivery</td>
                            </tr>
                            <tr>
                                <th scope="row">Total:</th>
                                <td><span class="woocommerce-Price-amount"><span class="woocommerce-Price-currencySymbol">PHP </span><?= $orders[0]['total'] ?></span></td>
                            </tr>
                        </tfoot>
                    </table>

	            </section>
                <section class="woocommerce-customer-details">
                    <h2 class="woocommerce-column__title">Billing address</h2>
                    <address>
                        <?= $orders[0]['firstname'] ?>&nbsp;<?= $orders[0]['lastname'] ?><br>
                        <?= $orders[0]['city'] ?><br>
                        <?= $orders[0]['address'] ?><br>
                        <?= $orders[0]['province'] ?><br>
                        <?= $orders[0]['postal_code'] ?><br>
                        <span class="woocommerce-customer-details--phone"><?= $orders[0]['phone_number'] ?></span><br>
                        <span class="woocommerce-customer-details--email"><?= $orders[0]['email'] ?></span>
                    </address>
                </section>
            </div>
        </div>
    </div>
	
</div>