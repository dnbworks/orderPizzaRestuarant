<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pizza | <?= $this->title; ?></title>

    
    <link rel="stylesheet" href="asset/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="asset/css/header.css">

    <link rel="stylesheet" href="asset/css/<?= $this->title ?>.css">
    <link rel="stylesheet" href="asset/css/global.css">
    <link rel="shortcut icon" href="asset/img/logo.png" type="image/png">

    <script src="asset/js/font_awesome.js"></script>
    <script src="asset/js/global.js" defer></script>
</head>
<body>
    <?php
        include_once dirname(__DIR__). "/partials/nav.php";
    ?>  
 
    {{content}}

    <?php
        include_once dirname(__DIR__). "/partials/footer.php";
        include_once dirname(__DIR__). "/partials/sidenav.php";
    ?>  
    
</body>
</html>