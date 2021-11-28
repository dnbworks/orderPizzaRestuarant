<?php
    $this->title = 'Dashboard';
    use app\core\Application;
?>

<div class="container">
    <h3>My account</h3>
    <div class="row">
        <div class="col-3">
            <ul class="MyAccount-navigation">
                <li class="MyAccount-navigation-link MyAccount-navigation-link--dashboard is-active">
                    <a href="/my-account">Dashboard</a>
                </li>
                <li class="MyAccount-navigation-link MyAccount-navigation-link--orders">
                    <a href="/my-account/orders">Orders</a>
                </li>
                <li class="MyAccount-navigation-link MyAccount-navigation-link--downloads">
                    <a href="/my-account/downloads">Downloads</a>
                </li>
                <li class="MyAccount-navigation-link MyAccount-navigation-link--edit-address">
                    <a href="/my-account/edit-address">Addresses</a>
                </li>
                <li class="MyAccount-navigation-link MyAccount-navigation-link--edit-account">
                    <a href="/my-account/edit-account">Account details</a>
                </li>
                <li class="MyAccount-navigation-link MyAccount-navigation-link--customer-logout">
                    <form action="/logout" method="post" class="nostyle">
                        <button type="submit" class="btn"> Logout</button>
                    </form>
                </li>
            </ul>
        </div>
        <div class="col-8">
            <p>Hello <strong><?= Application::$app->user->getDisplayName() ?></strong> (not <strong><?= Application::$app->user->getDisplayName() ?></strong>? <a href="/my-account/customer-logout/">Log out</a>)</p>
            <p>From your account dashboard you can view your <a href="/my-account/orders">recent orders</a>, manage your <a href="/my-account/edit-address">shipping and billing addresses</a>, and <a href="/my-account/edit-account/">edit your password and account details</a>.</p>
        </div>
    </div>
</div>
