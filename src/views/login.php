<?php
    $this->title = 'Account';
    use app\core\Application;
?>

<div class="container py account">
    <h2 style="text-align: center;">Account</h2>
    <?php if(Application::$app->session->getFlash('success')): ?>
        <div class="alert alert-success">
            <?php echo Application::$app->session->getFlash('success'); ?>
        </div>
    <?php endif; ?>
    <div class="row justify-content-around py">
        <div class="col-12 col-md-5 col-lg-5">
            <h3>New Customer</h3>
            <p>By creating an account with our store, you will be able to move through the checkout process faster, store multiple shipping addresses, view and track your order in your account and more.</p>
            <a href="/register" class="create_account">Create account</a>
        </div>
        <div class="col-12 col-md-5 col-lg-5">
            <h3>Registered Customer</h3>
            <p>If you have an account with us, please log in to view your saved delivery addresses.</p>
            <form action="/login" method="post">
                <label for="email">Email Address</label>
                <input type="text" class="form-control <?php echo $model->hasError("email") ? 'isInvalid' : ''; ?>" id="email" name="email" value="<?php echo $model->email; ?>" placeholder="Type email address here">
                <p class="invalid"><?php echo $model->getFirstError("email"); ?></p>
                <label for="password">Password</label>
                <input  type="password" class="form-control <?php echo $model->hasError("password") ? 'isInvalid' : ''; ?>" id="password" name="password" value="<?php if (!empty($password1)) echo $password1;   ?>" placeholder="Type password here">
                <p class="invalid"><?php echo $model->getFirstError("password"); ?></p>
                <input type="submit" value="Login">
                <p>Forgot your Password?</p>
            </form>
        </div>
    </div>
</div>
