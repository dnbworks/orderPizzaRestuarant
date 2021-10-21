<?php
    use app\core\Application;
    use app\core\Session;

    $this->title = 'order';
    // echo '<pre>';
    // var_dump($_SESSION['cart']);
    // echo '</pre>';

?>

<div class="order-here" style="position: relative;">
        <div class="shadow"></div>
        <div class="order" style="height: 60px;">

        </div>
        <div class="container">
            <div class="row justify-content-between align-items-start">
                <div class="col-12 col-md-4 col-lg-3 catergory">
                    <ul>
                        <li class="active li type" id="Special Offers">
                            <a href="#" class="d-flex justify-content-between type">
                                <span class="type">Special Offers</span>
                                <span><i class="fas fa-chevron-right" ></i></span>
                            </a>
                        </li>
                        <li class="li" id="Pizza">
                            <a href="#" class="d-flex justify-content-between">
                                <span class="type">Pizza</span>
                                <span><i class="fas fa-chevron-right"></i></span>
                            </a>
                        </li>
                        <li class="li" id="Pasta">
                            <a href="#" class="d-flex justify-content-between">
                                <span class="type">Pasta</span>
                                <span><i class="fas fa-chevron-right"></i></span>
                            </a>
                        </li>
                        <li class="li" id="Group Meals">
                            <a href="#" class="d-flex justify-content-between">
                                <span class="type">Group Meals</span>
                                <span><i class="fas fa-chevron-right"></i></span>
                            </a>
                           
                        </li>
                        <li class="li" id="Solo Meals">
                            <a href="#" class="d-flex justify-content-between">
                                <span class="type">Solo Meals</span>
                                <span><i class="fas fa-chevron-right"></i></span>
                            </a>
                        </li>
                        <li class="li" id="Chicken">
                            <a href="#" class="d-flex justify-content-between">
                                <span class="type">Chicken</span>
                                <span><i class="fas fa-chevron-right"></i></span>
                            </a>
                        </li>
                        <li class="li" id="Drinks">
                            <a href="#" class="d-flex justify-content-between">
                                <span class="type">Drinks</span>
                                <span><i class="fas fa-chevron-right"></i></span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-12 col-md-8 col-lg-9">
                    <div class="pre-loader">
                        <img src="asset/img/loader.gif" alt="" srcset="" width="40px">
                    </div>
                    <div class="flex-item menu-content">
                        <?php foreach($pizzas as $pizza): ?>
                            <div class="item">
                            <div class="views-field views-field-field-product-image">
                                <div class="field-content">
                                    <a href="/order?type=<?= $pizza["category"] ?>&name=<?= $pizza["title"] ?>">
                                        <div class="media media--blazy  media--image">
                                            <div class="loader">
                                                <img src="/asset/img/loader.svg" alt="" srcset="" id="loader">
                                            </div>
                                            <img height="220" width="220" class="b-lazy media__image media__element b-loaded" alt="Carbonara Supreme" src="/asset/img/<?= $pizza["img"] ?>" typeof="foaf:Image">
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <span class="views-field views-field-title">
                                <span class="field-content product-list-title">
                                    <a href="meal.html" hreflang="en"><?= $pizza["title"] ?></a>
                                </span>
                            </span>
                            <div class="views-field views-field-body">
                                <div class="field-content">
                                    <p><?= substr($pizza["description"], 0, 50) . '...'  ?></p>
                                </div>
                            </div>

                            <div class="views-field views-field-price__number">
                                <span class="field-content">PHP <?= $pizza["price"] ?></span>
                            </div>
                         
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="pagination d-flex justify-content-center"></div>
                </div>
            </div>
        </div>
    </div>

    <?php
        $script = '<script src="asset/js/order.js"></script>';
    ?>

    