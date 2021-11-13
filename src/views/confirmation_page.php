<?php
     $this->title = 'order-success';
     use app\core\Application;
     use app\helpers\DateHelper;
     
    // $sql = "INSERT INTO `order_items` (`order_id`, `cart_item_id`, `product_id`, `quantity`, `adddon`) VALUES ";
    // $values = "";
    // $values_array = [];
    //  foreach($_SESSION['cart']->getItems() as $item){
    //     $values_array[] = "('1', '" . $item->getProduct()->getProductAttributes()['CartItemId'] . "', '" . $item->getProduct()->getProductAttributes()['id'] . "', '" . $item->getProduct()->getProductAttributes()['options']['number'] . "', " . json_encode($item->getProduct()->getProductAttributes()['options']) . ")";
    //  }

    //  $final_query = $sql . implode(", ", $values_array);
 
    
    // echo $final_query;
    //  exit;
  
     // order-received

        
    // echo '<pre>';
    // var_dump($order_details);
    // echo '</pre>';

    

?>

<div class="container my-5">
    <header class="entry-header ast-no-thumbnail ast-no-meta">
		<h1 class="entry-title" itemprop="headline">Checkout</h1>
    </header>
    <p class="store-notice success thankyou-order-received">Thank you. Your order has been received.</p>
    <?php if($order_details): ?>
    <ul class="order_details">
        <li class="woocommerce-order-overview__order order">
            Order number: <strong><?= $order_details[0]['order_id'] ?></strong>
        </li>
        <li class="woocommerce-order-overview__date date">
            Date: <strong><?= DateHelper::format_data($order_details[0]['order_date']) ?></strong>
        </li>
        <li class="woocommerce-order-overview__total total">
            Total:	<strong><span class="woocommerce-Price-amount"><bdi><span class="woocommerce-Price-currencySymbol">PHP</span><?= $order_details[0]['total'] ?></bdi></span></strong>
        </li>
        <li class="woocommerce-order-overview__payment-method method">
            Payment method:	<strong>Cash on delivery</strong>
        </li>
    </ul>
    <p class="store-notice">Pay with cash upon delivery.</p>
    <section class="woocommerce-order-details">
	    <h2 class="order-details__title">Order details</h2>
	    <table class="table">
            <thead>
                <tr>
                    <th class="woocommerce-table__product-name product-name">Product</th>
                    <th class="woocommerce-table__product-table product-total">Total</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($order_details as $item): ?>
                <tr class="woocommerce-table__line-item order_item">
                    <td class="woocommerce-table__product-name product-name">
                        <a href="http://localhost/wordpress/product/gig-shorts/"><?= $item['title'] ?></a> <strong class="product-quantity">×&nbsp;<?= $item['quantity'] ?></strong>	</td>
                    <td class="woocommerce-table__product-total product-total">
                        <span class="woocommerce-Price-amount"><bdi><span class="woocommerce-Price-currencySymbol">PHP </span><?= $item['subtotal'] ?></bdi></span>	</td>
                </tr>
            <?php endforeach; ?>
            </tbody>
            <tfoot>
                 <tr>
                    <td scope="row"><strong>Subtotal:</strong></th>
                    <td><span class="woocommerce-Price-amount"><span class="woocommerce-Price-currencySymbol">PHP </span><?= $order_details[0]['total'] ?></span></td>
                </tr>
                <tr>
                    <td scope="row"><strong>Payment method:</strong></th>
                    <td>Cash on delivery</td>
                </tr>
                <tr>
                    <td scope="row"><strong>Total:</strong></th>
                    <td><span class="woocommerce-Price-amount"><span class="woocommerce-Price-currencySymbol">PHP </span><?= $order_details[0]['total'] ?></td>
                </tr>
            </tfoot>
	    </table>
	</section>
    <?php endif; ?>
  

                
            
         
</div>