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
<div class="woocommerce-MyAccount-content container">
	<div class="woocommerce-notices-wrapper"></div>
    <p class="entry-content">Order #<mark class="order-number">30</mark> was placed on <mark class="order-date">October 28, 2021</mark> and is currently <mark class="order-status">Processing</mark>.</p>

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
		    John Denver<br>
            Maralique highway<br>
            liro unit 1<br>
            Sampaloc<br>
            Rizal<br>
            2342
            <p class="woocommerce-customer-details--phone">09477705099</p>
            <p class="woocommerce-customer-details--email">johndenver@gamil.com</p>
		</address>
	</section>
</div>