<?php
    $this->title = 'Dashboard';
    use app\core\Application;
?>

<div class="container">
    <h3>My account</h3>
    <div class="row">
        <div class="col-3">
            <?php require 'partials/sidenav.php'; ?>
        </div>
        <div class="col-8">
            <p>Hello <strong><?= Application::$app->user->getDisplayName() ?></strong> (not <strong><?= Application::$app->user->getDisplayName() ?></strong>? <a href="/my-account/customer-logout/">Log out</a>)</p>
            <p>From your account dashboard you can view your <a href="/my-account/orders">recent orders</a>, manage your <a href="/my-account/edit-address">shipping and billing addresses</a>, and <a href="/my-account/edit-account/">edit your password and account details</a>.</p>
        </div>
    </div>
</div>
