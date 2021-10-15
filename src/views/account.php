<?php
    $this->title = 'Account';
?>



<div class="container py account">
    <h2 style="text-align: center;">Account</h2>
    <div class="row justify-content-around py">
        <div class="col-12 col-md-5 col-lg-5">
            <h3>New Customer</h3>
            <p>By creating an account with our store, you will be able to move through the checkout process faster, store multiple shipping addresses, view and track your order in your account and more.</p>
            <a href="/register" class="create_account">Create account</a>
        </div>
        <div class="col-12 col-md-5 col-lg-5">
            <h3>Registered Customer</h3>
            <p>If you have an account with us, please log in to view your saved delivery addresses.</p>
            <form action="" method="post">
                <label for="email">Email Address</label>
                <input type="email" name="email" id="email" placeholder="Type email address here">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Type email address here">
                <input type="submit" value="Login">
                <p>Forgot your Password?</p>
            </form>
        </div>
    </div>
</div>
