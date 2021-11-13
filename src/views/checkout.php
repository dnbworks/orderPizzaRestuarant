<?php
    $this->title = 'checkout';
  

    $items = $cart->getItems();
    // echo '<pre>';
    // var_dump($items);
    // echo '</pre>';
?>

 <!--Main layout-->
 <main class="mt-3 pt-4 checkout">
  
    <div class="container wow fadeIn">

      <!-- Heading -->
      <h2 class="my-4 h2 text-center">Checkout form</h2>
        <div class="coupon">
          <span>Have a coupon? <a href="#">Click here to enter your code</a></span>
          <!-- Promo code -->
          <form action="/coupon" method="post">
            <p>If you have a coupon code, please apply it below.</p>
            <div class="input-group d-flex">
              <input type="text" class="form-control" placeholder="Coupon code" aria-label="Recipient's username" aria-describedby="basic-addon2">
              <button class="btn btn-secondary" type="button" width="200px">Apply Coupon</button>
            </div>
          </form>
          <!-- Promo code -->
        </div>
        
      
      <!--Grid row-->
      <form class="card-body" action="/place-order" method="post" id="place_order">
        <p>How do you want us to serve you</p>
          <div class="my-3 d-flex">
            <div class="custom-control custom-radio mr-3 ml-0">
              <input id="delivery" name="deliveryMethod" type="radio" class="custom-control-input" value="2" checked required>
              <label class="custom-control-label" for="delivery">Delivery</label>
            </div>
            <div class="custom-control custom-radio mx-3">
              <input id="pickup" name="deliveryMethod" type="radio" class="custom-control-input" value="1" required>
              <label class="custom-control-label" for="pickup">PickUp</label>
            </div>
          </div>
         
      <div class="row justify-content-between">

        <!--Grid column-->
        <div class="col-md-6 mb-4">
          <hr class="mb-4">
          <!--Card-->
          <div class="card">
            <!--Card content-->
              <div class="billing-info">
                <p>Your Billing Information</p>
                <table class="table table-striped">
                   <tr>
                      <td>Full name: </td>
                      <td><?php echo $user->firstname; ?> <?php echo $user->lastname; ?></td>
                  </tr>
                  <tr>
                      <td>City: </td>
                      <td><?php echo $user->city; ?></td>
                  </tr>
                  <tr>
                      <td>Province: </td>
                      <td><?php echo $user->province; ?></td>
                  </tr>
                  <tr>
                      <td>Address: </td>
                      <td><?php echo $user->address; ?></td>
                  </tr>
                  <tr>
                      <td>Postal code: </td>
                      <td><?php echo $user->postal_code; ?></td>
                  </tr>
                </table>
              </div>

              <!-- <p>Payment Method</p>
              <div class="my-3 d-flex">
                <div class="custom-control custom-radio mr-3 ml-0">
                  <input id="credit" name="paymentMethod" type="radio" class="custom-control-input" checked required>
                  <label class="custom-control-label" for="credit">Credit card</label>
                </div>
                <div class="custom-control custom-radio mx-3">
                  <input id="debit" name="paymentMethod" type="radio" class="custom-control-input" required>
                  <label class="custom-control-label" for="debit">Debit card</label>
                </div>
                <div class="custom-control custom-radio mx-3">
                  <input id="paypal" name="paymentMethod" type="radio" class="custom-control-input" required>
                  <label class="custom-control-label" for="paypal">Paypal</label>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="cc-name">Name on card</label>
                  <input type="text" class="form-control" id="cc-name" placeholder="" required>
                  <div class="invalid-feedback">
                    Name on card is required
                  </div>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="cc-number">Credit card number</label>
                  <input type="text" class="form-control" id="cc-number" placeholder="" required>
                  <div class="invalid-feedback">
                    Credit card number is required
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3 mb-3">
                  <label for="cc-expiration">Expiration</label>
                  <input type="text" class="form-control" id="cc-expiration" placeholder="" required>
                  <div class="invalid-feedback">
                    Expiration date required
                  </div>
                </div>
                <div class="col-md-3 mb-3">
                  <label for="cc-cvv">CVV</label>
                  <input type="text" class="form-control" id="cc-cvv" placeholder="" required>
                  <div class="invalid-feedback">
                    Security code required
                  </div>
                </div>
              </div> -->
              <hr class="mb-4">

          </div>
          <!--/.Card-->

        </div>
        <!--Grid column-->

        <!--Grid column-->
        <div class="col-md-5 mb-5">

          <!-- Heading -->
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Your Order</span>
            <span class="badge badge-secondary badge-pill"><?= $_SESSION['cart']->getTotalQuantity() ?></span>
          </h4>

          <!-- Cart -->
            <table class="table">
              <thead>
              <tr>
                <th class="product-name">Product</th>
                <th class="product-total">Subtotal</th>
              </tr>
              </thead>
              <tbody>
                <?php foreach($items as $item): ?>
                  <tr class="cart_item">
                    <td class="product-name">
                      <div class="d-flex align-items-center">
                        <img src="asset/img/<?= $item->getProduct()->getProductAttributes()['img'] ?>" alt="" srcset="" width="30px" style="margin-right: 5px;">
                        <span><?= $item->getProduct()->getProductAttributes()['title'] ?></span>&nbsp;<strong class="product-quantity">×&nbsp;<?= $item->getProduct()->getProductAttributes()['options']['number'] ?></strong>
                      </div>	
                    </td>
                    <td class="product-total">
                      <div class="d-flex align-items-center">
                        <span class="Price-amount">
                            <span class="Price-currencySymbol">PHP</span> <?= app\helpers\PriceHelper::formatMoney((float)$item->getProduct()->getProductAttributes()['price'] * (int)$item->getProduct()->getProductAttributes()['options']['number']) ?>
                        </span>	
                      </div>	
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
              <tfoot>
                <tr class="cart-subtotal">
                  <th>Subtotal</th>
                  <td><span class="Price-amount"><bdi><span class="Price-currencySymbol">PHP </span><?= app\helpers\PriceHelper::formatMoney($cart->getTotalSum()) ?></bdi></span></td>
                </tr>
                <tr class="order-total">
                  <th>Total</th>
                  <td><strong><span class="Price-amount"><bdi><span class="Price-currencySymbol">PHP </span><?= app\helpers\PriceHelper::formatMoney($cart->getTotalSum()) ?></bdi></span></strong> </td>
                </tr>
              </tfoot>
            </table>
          <!-- Cart -->


          <button class="btn btn-primary btn-lg btn-block" type="submit">Place Order</button>
          <div class="woocommerce-privacy-policy-text">
            <p>Your personal data will be used to process your order, support your experience throughout this website, and for other purposes described in our <a href="http://localhost/wordpress/?page_id=3" class="woocommerce-privacy-policy-link" target="_blank">privacy policy</a>.</p>
        </div>

        </div>
        <!--Grid column-->

      </div>
    </form>
      <!--Grid row-->

    </div>
  </main>
  <!--Main layout-->

