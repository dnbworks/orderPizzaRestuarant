
<?php
    use app\core\Application;
    $this->title = 'meal';
?>
<main>
    <div class="shadow"></div>
    <div class="container" style="padding-top: 30px !important; padding-bottom: 30px !important;">
        <div class="row justify-content-around">
            <?php if($status == 'show') : ?>
                <div class="col-12 col-md-5 col-lg-5">
                    <figure>
                        <div class="loader-div">
                            <img src="asset/img/loader.svg" alt="" srcset="" id="loader">
                        </div>
                        <img src="/asset/img/<?= $pizza["img"] ?>" alt="" srcset="" id="thumb">
                    </figure>
                    <!-- <div class="magnifier-preview" id="preview" style="width: 200px; height: 133px"></div> -->
                    <h4 id="<?= $pizza["product_id"] ?>"><?= $pizza["title"] ?></h4>
                    <?= $status ?>
                    <p><?= $pizza["description"] ?></p>
                </div>
                <div class="col-12 col-md-5 col-lg-5">
                    <span class="title">Select your options</span>
                    <?= Application::$app->render->renderHtml($pizza["category"]) ?>
                </div>
            <?php else : ?>
                <div class="col-12 col-md-5 col-lg-5">
                    <figure>
                        <div class="loader-div">
                            <img src="asset/img/loader.svg" alt="" srcset="" id="loader">
                        </div>
                        <img src="/asset/img/<?= $pizza["img"] ?>" alt="" srcset="" id="thumb">
                    </figure>
                    <!-- <div class="magnifier-preview" id="preview" style="width: 200px; height: 133px"></div> -->
                    <h4 id="<?= $pizza["product_id"] ?>"><?= $pizza["title"] ?></h4>
                    <!-- <?= $status ?> -->
                    <p><?= $pizza["description"] ?></p>
                </div>
                <div class="col-12 col-md-5 col-lg-5">
                    <span class="title">Select your options</span>
                    <?= Application::$app->render->renderHtml($pizza["category"], ['btn' => 'Update Order', 'options' => $options]) ?>
                </div>
            <?php endif; ?>
            
        </div>
    </div>
</main>