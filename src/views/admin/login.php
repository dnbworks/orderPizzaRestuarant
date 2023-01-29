<?php
    $this->title = 'login';
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
            <h3>Register new user</h3>
            <a href="/register" class="create_account">Create account</a>
        </div>
        <div class="col-12 col-md-5 col-lg-5">
            <h3>Sign in User</h3>
            <p>If you have an account with us, please log in to view your saved delivery addresses.</p>
            <form action="/login" method="post">
                <label for="email">Email Address</label>
                <input type="text" class="form-control" id="email" name="email" value="" placeholder="Type email address here">
                <p class="invalid"></p>
                <label for="password">Password</label>
                <input  type="password" class="form-control" id="password" name="password" value="" placeholder="Type password here">
                <p class="invalid"></p>
                <input type="submit" value="Login">
                <p>Forgot your Password?</p>
            </form>
        </div>
    </div>
</div>