<?php
    use app\core\Application;

?>

<?php if(!Application::isGuest()) : ?>
    <nav class="d-flex justify-content-between align-items-center">
        <a href="/" class="logo">FindMyDate</a>
        <form action="/logout" method="post" class="nostyle">
            <button type="submit" class="btn btn-sm btn-primary"><?php echo Application::$app->user->getDisplayName(); ?> Logout</button>
        </form>
    </nav>
<?php endif; ?>
