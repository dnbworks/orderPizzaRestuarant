
<?php
    use app\core\Application;
    $this->title = 'meal';

    // echo '<pre>';
    // var_dump($pizza);
    // echo '</pre>';
    // exit;
?>
<main>
        <div class="shadow"></div>
        <div class="container" style="padding-top: 30px !important; padding-bottom: 30px !important;">
            <div class="row justify-content-around">
                <div class="col-12 col-md-5 col-lg-5">
                    <figure>
                        <div class="loader-div">
                            <img src="asset/img/loader.gif" alt="" srcset="" id="loader">
                        </div>
                        <img src="/asset/img/<?= $pizza["img"] ?>" alt="" srcset="" id="thumb">
                    </figure>
                    <!-- <div class="magnifier-preview" id="preview" style="width: 200px; height: 133px"></div> -->
                    <h4><?= $pizza["title"] ?></h4>
                    <p><?= $pizza["description"] ?></p>
                </div>
                <div class="col-12 col-md-5 col-lg-5">
                    <span class="title">Select your options</span>
                    <form action="" method="post" id="form_options">
                        <label for="size">Choose your pizza size</label>
                        <div style="margin-bottom: 10px; position: relative;">
                            <i class="fas fa-angle-down"></i>
                            <input type="text" name="size" class="input-text" placeholder="Choose your size" data-listen="input" autocomplete="off" readonly="" data-required-validate="true" id="size">
                            <ul class="[ u-df-mb u-df-mb-fd-c ]">
                                <li class="[ u-df-mb ] " data-combination-value="2205-6846" data-select-value="Regular" data-price-value="210" data-product="14233">
                                    <div class="o-form-dropdown_input--item [ u-df-mb u-df-mb-fd-c u-df-mb-jc-c ]">
                                        <h5 class="h5">Regular</h5> 
                                        <div class="o-form-dropdown_input--item__subdetail [ u-df-mb ]">
                                            <span>Php 210.00</span>
                                        </div>
                                    </div>
                                </li>
                                <li class="[ u-df-mb ] " data-combination-value="2205-6847" data-select-value="Large" data-price-value="380" data-product="14233">
                                    <div class="o-form-dropdown_input--item [ u-df-mb u-df-mb-fd-c u-df-mb-jc-c ]">
                                        <h5 class="h5">Large</h5> 
                                        <div class="o-form-dropdown_input--item__subdetail [ u-df-mb ]">
                                            <span>Php 380.00</span>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <label for="condiments">Choose your condiments</label>
                        <div style="margin-bottom: 10px; position: relative;">
                            <i class="fas fa-angle-down"></i>
                            <input type="text" name="condiments" class="input-text" placeholder="Choose your condiments" data-listen="input" autocomplete="off" readonly="" data-required-validate="true" id="condiments">
                            <ul class="[ u-df-mb u-df-mb-fd-c ]">
                                <li class="[ u-df-mb ] " data-combination-value="2205-6846" data-select-value="Hot Chix" data-price-value="210" data-product="14233">
                                    <div class="o-form-dropdown_input--item [ u-df-mb u-df-mb-fd-c u-df-mb-jc-c ]">
                                        <h5 class="h5">Hot Chix</h5> 
                                        <div class="o-form-dropdown_input--item__subdetail [ u-df-mb ]">
                                            <span>Php 15.10</span>
                                        </div>
                                    </div>
                                </li>
                                <li class="[ u-df-mb ] " data-combination-value="2205-6847" data-select-value="Sweet Soy" data-price-value="380" data-product="14233">
                                    <div class="o-form-dropdown_input--item [ u-df-mb u-df-mb-fd-c u-df-mb-jc-c ]">
                                        <h5 class="h5">Lime</h5> 
                                        <div class="o-form-dropdown_input--item__subdetail [ u-df-mb ]">
                                            <span>Php 20.00</span>
                                        </div>
                                    </div>
                                </li>
                                <li class="[ u-df-mb ] " data-combination-value="2205-6847" data-select-value="Sweet Soy" data-price-value="380" data-product="14233">
                                    <div class="o-form-dropdown_input--item [ u-df-mb u-df-mb-fd-c u-df-mb-jc-c ]">
                                        <h5 class="h5">Ketchup - 1 Sachet</h5> 
                                        <div class="o-form-dropdown_input--item__subdetail [ u-df-mb ]">
                                            <span>Php 5.00</span>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <label for="pizza_cut">Choose your pizza cut</label>
                        <div style="margin-bottom: 10px; position: relative;">
                            <i class="fas fa-angle-down"></i>
                            <input type="text" name="pizza_cut" class="input-text" placeholder="Choose your pizza cut" data-listen="input" autocomplete="off" readonly="" data-required-validate="true" id="pizza_cut">
                            <ul class="[ u-df-mb u-df-mb-fd-c ]">
                                <li class="[ u-df-mb ] " data-combination-value="2205-6846" data-select-value="Hot Chix" data-price-value="210" data-product="14233">
                                    <div class="o-form-dropdown_input--item [ u-df-mb u-df-mb-fd-c u-df-mb-jc-c ]">
                                        <h5 class="h5">Regular Cut</h5> 
                                    </div>
                                </li>
                                <li class="[ u-df-mb ] " data-combination-value="2205-6847" data-select-value="Sweet Soy" data-price-value="380" data-product="14233">
                                    <div class="o-form-dropdown_input--item [ u-df-mb u-df-mb-fd-c u-df-mb-jc-c ]">
                                        <h5 class="h5">Square Cut</h5> 
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <label for="">Special Instruction (optional)</label>
                        <textarea name="" id="" placeholder="Add Special Instruction here"></textarea>

                        <div>
                            quantity
                            <div class="quantity">
                                <img src="asset/img/minus.jpg" alt="" srcset="" width="16px">
                                    <span>1</span>
                                <img src="asset/img/plus.jpg" alt="" srcset="" width="16px">
                            </div>
                        </div>
                        <div>
                            order Summary
                        </div>
                        <button type="submit">
                            <img src="asset/img/loader.gif" alt="" srcset="">
                            Add to Tray
                        </button>
                    </form>
                </div>
            </div>
        </div>


    </main>