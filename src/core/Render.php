<?php


namespace app\core;

class Render 
{
    private string $pizza = 'Pizza';
    private string $pasta = 'Pasta';
    private string $group_meals = 'Group Meals';
    private string $solo_meals = 'Solo Meals';
    private string $chicken = 'Chicken';
    private string $drink = 'Drinks';


    public function renderHtml(string $type, array $params = []): string
    {
        $html = '';
        switch ($type) {
            case $this->pizza:
                $html = $this->renderPizza($params);
                break;
            case $this->pasta;
                $html = $this->renderPasta($params);
                break;
            case $this->group_meals:
                $html = $this->renderGroupMeal($params);
                break;
            case $this->solo_meals:
                $html = $this->renderSoloMeal($params);
                break;
            case $this->chicken:
                $html = $this->renderChicken($params);
                break;
            case $this->drink:
                $html = $this->renderDrink($params);
                break;
            
        }

        return $html;
    }


    private function renderPizza($params): string
    {
        // render form inputs based on whether the user is in update product or just displaying the product using the tenary operator

        // size input
        $size = isset($params['options']['size']) ? '<input type="text" name="size" class="input-text input" placeholder="Choose your size" data-listen="input" autocomplete="off" readonly="" data-required-validate="true" id="size" value="' . $params['options']['size'] . '">' : ' <input type="text" name="size" class="input-text input" placeholder="Choose your size" data-listen="input" autocomplete="off" readonly="" data-required-validate="true" id="size">'; // end size input
        
        // size input
        $condiments = isset($params['options']['condiments']) ? '<input type="text" name="condiments" class="input-text input" placeholder="Choose your condiments" data-listen="input" autocomplete="off" readonly="" data-required-validate="true" id="size" value="' . $params['options']['condiments'] . '">' : ' <input type="text" name="condiments" class="input-text input" placeholder="Choose your condiments" data-listen="input" autocomplete="off" readonly="" data-required-validate="true" id="condiments">'; // end size input

        $pizza_cut = isset($params['options']['pizza_cut']) ? '<input type="text" name="pizza_cut" class="input-text input" placeholder="Choose your pizza cut" data-listen="input" autocomplete="off" readonly="" data-required-validate="true" id="size" value="' . $params['options']['pizza_cut'] . '">' : ' <input type="text" name="pizza_cut" class="input-text input" placeholder="Choose your pizza cut" data-listen="input" autocomplete="off" readonly="" data-required-validate="true" id="pizza_cut">';
        

        // instruction input
        $instruction = isset($params['options']['Instruction']) ? '<textarea name="Instruction" id="Instruction" class="input" placeholder="Add Special Instruction here">'.$params['options']['Instruction'].'</textarea>' : '<textarea name="Instruction" id="Instruction" class="input" placeholder="Add Special Instruction here"></textarea>'; // end instruction input

        // Quantity input
        $quantity = isset($params['options']['number']) ? '<div class="quantity"><div class="value-button" id="decrease" value="Decrease Value">-</div><input type="number" id="number" class="input" value="'. $params['options']['number'].'" /><div class="value-button" id="increase" value="Increase Value">+</div></div>' : ' <div class="quantity"><div class="value-button" id="decrease" value="Decrease Value">-</div><input type="number" id="number" class="input" value="1" /><div class="value-button" id="increase" value="Increase Value">+</div></div>'; // end Quantity input

        // button input
        $button = isset($params['btn']) ? '<button type="submit" id="update"><img src="asset/img/loader.svg" alt="" srcset="">'. $params['btn'] . '</button>' : ' <button type="submit" id="add"><img src="asset/img/loader.svg" alt="" srcset="">Add to Tray</button>'; // end button input
        $html = <<<HTML
                <form action="" method="post" id="form_options">
                    <label for="size">Choose your pizza size</label>
                    <div style="margin-bottom: 10px; position: relative;">
                        <i class="fas fa-angle-down"></i>
                        <!-- <input type="text" name="size" class="input-text input" placeholder="Choose your size" data-listen="input" autocomplete="off" readonly="" data-required-validate="true" id="size"> -->
                        $size
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
                        <!-- <input type="text" name="condiments" class="input-text input" placeholder="Choose your condiments" data-listen="input" autocomplete="off" readonly="" data-required-validate="true" id="condiments"> -->
                        $condiments
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
                        <!-- <input type="text" name="pizza_cut" class="input-text input" placeholder="Choose your pizza cut" data-listen="input" autocomplete="off" readonly="" data-required-validate="true" id="pizza_cut"> -->
                        $pizza_cut
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
                    <label for="Instruction">Special Instruction (optional)</label>
                    <!-- <textarea name="Instruction" id="Instruction" class="input" placeholder="Add Special Instruction here"></textarea> -->
                    $instruction
                    <label for="number">Quantity</label>
                    <!-- <div class="quantity">
                        <div class="value-button" id="decrease" value="Decrease Value">-</div>
                        <input type="number" id="number" class="input" value="1" />
                        <div class="value-button" id="increase" value="Increase Value">+</div>
                    </div> -->
                    $quantity
                <!-- <button type="submit">
                    <img src="asset/img/loader.svg" alt="" srcset="">
                    Add to Tray
                </button> -->
                    $button
            </form>
        HTML;
        return $html;
    }


    private function renderPasta($params): string
    {
        // render form inputs based on whether the user is in update product or just displaying the product using the tenary operator

        // size input
        $size = isset($params['options']['size']) ? '<input type="text" name="size" class="input-text input" placeholder="Choose your size" data-listen="input" autocomplete="off" readonly="" data-required-validate="true" id="size" value="' . $params['options']['size'] . '">' : ' <input type="text" name="size" class="input-text input" placeholder="Choose your size" data-listen="input" autocomplete="off" readonly="" data-required-validate="true" id="size">'; // end size input
        
        // instruction input
        $instruction = isset($params['options']['Instruction']) ? '<textarea name="Instruction" id="Instruction" class="input" placeholder="Add Special Instruction here">'.$params['options']['Instruction'].'</textarea>' : '<textarea name="Instruction" id="Instruction" class="input" placeholder="Add Special Instruction here"></textarea>'; // end instruction input

        // Quantity input
        $quantity = isset($params['options']['number']) ? '<div class="quantity"><div class="value-button" id="decrease" value="Decrease Value">-</div><input type="number" id="number" class="input" value="'. $params['options']['number'].'" /><div class="value-button" id="increase" value="Increase Value">+</div></div>' : ' <div class="quantity"><div class="value-button" id="decrease" value="Decrease Value">-</div><input type="number" id="number" class="input" value="1" /><div class="value-button" id="increase" value="Increase Value">+</div></div>'; // end Quantity input

        // button input
        $button = isset($params['btn']) ? '<button type="submit" id="update"><img src="asset/img/loader.svg" alt="" srcset="">'. $params['btn'] . '</button>' : ' <button type="submit" id="add"><img src="asset/img/loader.svg" alt="" srcset="">Add to Tray</button>'; // end button input
        $html = <<<HTML
                <form action="" method="post" id="form_options">
                    <label for="size">Choose your Plate size</label>
                    <div style="margin-bottom: 10px; position: relative;">
                        <i class="fas fa-angle-down"></i>
                        <!-- <input type="text" name="size" class="input-text input" placeholder="Choose your size" data-listen="input" autocomplete="off" readonly="" data-required-validate="true" id="size"> -->
                        $size
                        <ul class="[ u-df-mb u-df-mb-fd-c ]">
                            <li class="[ u-df-mb ] " data-combination-value="2205-6846" data-select-value="Regular" data-price-value="210" data-product="14233">
                                <div class="o-form-dropdown_input--item [ u-df-mb u-df-mb-fd-c u-df-mb-jc-c ]">
                                    <h5 class="h5">Solo</h5> 
                                    <div class="o-form-dropdown_input--item__subdetail [ u-df-mb ]">
                                        <span>Php 210.00</span>
                                    </div>
                                </div>
                            </li>
                            <li class="[ u-df-mb ] " data-combination-value="2205-6847" data-select-value="Large" data-price-value="380" data-product="14233">
                                <div class="o-form-dropdown_input--item [ u-df-mb u-df-mb-fd-c u-df-mb-jc-c ]">
                                    <h5 class="h5">Platter</h5> 
                                    <div class="o-form-dropdown_input--item__subdetail [ u-df-mb ]">
                                        <span>Php 380.00</span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <label for="Instruction">Special Instruction (optional)</label>
                    <!-- <textarea name="Instruction" id="Instruction" class="input" placeholder="Add Special Instruction here"></textarea> -->
                    $instruction
                    <label for="number">Quantity</label>
                    <!-- <div class="quantity">
                        <div class="value-button" id="decrease" value="Decrease Value">-</div>
                        <input type="number" id="number" class="input" value="1" />
                        <div class="value-button" id="increase" value="Increase Value">+</div>
                    </div> -->
                    $quantity
                    <!-- <button type="submit">
                        <img src="asset/img/loader.svg" alt="" srcset="">
                        Add to Tray
                    </button> -->
                    $button
            </form>
        HTML;
        return $html;
    }

    private function renderGroupMeal($params): string
    {
         // render form inputs based on whether the user is in update product or just displaying the product using the tenary operator

        // size input
        $size = isset($params['options']['size']) ? '<input type="text" name="size" class="input-text input" placeholder="Choose your size" data-listen="input" autocomplete="off" readonly="" data-required-validate="true" id="size" value="' . $params['options']['size'] . '">' : ' <input type="text" name="size" class="input-text input" placeholder="Choose your size" data-listen="input" autocomplete="off" readonly="" data-required-validate="true" id="size">'; // end size input
        
        // instruction input
        $instruction = isset($params['options']['Instruction']) ? '<textarea name="Instruction" id="Instruction" class="input" placeholder="Add Special Instruction here">'.$params['options']['Instruction'].'</textarea>' : '<textarea name="Instruction" id="Instruction" class="input" placeholder="Add Special Instruction here"></textarea>'; // end instruction input

        // Quantity input
        $quantity = isset($params['options']['number']) ? '<div class="quantity"><div class="value-button" id="decrease" value="Decrease Value">-</div><input type="number" id="number" class="input" value="'. $params['options']['number'].'" /><div class="value-button" id="increase" value="Increase Value">+</div></div>' : ' <div class="quantity"><div class="value-button" id="decrease" value="Decrease Value">-</div><input type="number" id="number" class="input" value="1" /><div class="value-button" id="increase" value="Increase Value">+</div></div>'; // end Quantity input

        // button input
        $button = isset($params['btn']) ? '<button type="submit" id="update"><img src="asset/img/loader.svg" alt="" srcset="">'. $params['btn'] . '</button>' : ' <button type="submit" id="add"><img src="asset/img/loader.svg" alt="" srcset="">Add to Tray</button>'; // end button input

        $html = <<<HTML
                <form action="" method="post" id="form_options">
                    <label for="size">Choose your Plate Plate</label>
                    <div style="margin-bottom: 10px; position: relative;">
                        <i class="fas fa-angle-down"></i>
                        <!-- <input type="text" name="size" class="input-text input" placeholder="Choose your size" data-listen="input" autocomplete="off" readonly="" data-required-validate="true" id="size"> -->
                        $size
                        <ul class="[ u-df-mb u-df-mb-fd-c ]">
                            <li class="[ u-df-mb ] " data-combination-value="2205-6846" data-select-value="Regular" data-price-value="210" data-product="14233">
                                <div class="o-form-dropdown_input--item [ u-df-mb u-df-mb-fd-c u-df-mb-jc-c ]">
                                    <h5 class="h5">Solo</h5> 
                                    <div class="o-form-dropdown_input--item__subdetail [ u-df-mb ]">
                                        <span>Php 210.00</span>
                                    </div>
                                </div>
                            </li>
                            <li class="[ u-df-mb ] " data-combination-value="2205-6847" data-select-value="Large" data-price-value="380" data-product="14233">
                                <div class="o-form-dropdown_input--item [ u-df-mb u-df-mb-fd-c u-df-mb-jc-c ]">
                                    <h5 class="h5">Platter</h5> 
                                    <div class="o-form-dropdown_input--item__subdetail [ u-df-mb ]">
                                        <span>Php 380.00</span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                
                    <label for="Instruction">Special Instruction (optional)</label>
                    <!-- <textarea name="Instruction" id="Instruction" class="input" placeholder="Add Special Instruction here"></textarea> -->
                    $instruction

                    <label for="number">Quantity</label>
                    <!-- <div class="quantity">
                        <div class="value-button" id="decrease" value="Decrease Value">-</div>
                        <input type="number" id="number" class="input" value="1" />
                        <div class="value-button" id="increase" value="Increase Value">+</div>
                    </div> -->
                    $quantity
                    <!-- <button type="submit">
                        <img src="asset/img/loader.svg" alt="" srcset="">
                        Add to Tray
                    </button> -->
                    $button
                </form>
        HTML;
        return $html;
    }

    private function renderSoloMeal($params): string
    {
        // render form inputs based on whether the user is in update product or just displaying the product using the tenary operator

        // size input
        $size = isset($params['options']['size']) ? '<input type="text" name="size" class="input-text input" placeholder="Choose your size" data-listen="input" autocomplete="off" readonly="" data-required-validate="true" id="size" value="' . $params['options']['size'] . '">' : ' <input type="text" name="size" class="input-text input" placeholder="Choose your size" data-listen="input" autocomplete="off" readonly="" data-required-validate="true" id="size">'; // end size input
        
        // instruction input
        $instruction = isset($params['options']['Instruction']) ? '<textarea name="Instruction" id="Instruction" class="input" placeholder="Add Special Instruction here">'.$params['options']['Instruction'].'</textarea>' : '<textarea name="Instruction" id="Instruction" class="input" placeholder="Add Special Instruction here"></textarea>'; // end instruction input

        // Quantity input
        $quantity = isset($params['options']['number']) ? '<div class="quantity"><div class="value-button" id="decrease" value="Decrease Value">-</div><input type="number" id="number" class="input" value="'. $params['options']['number'].'" /><div class="value-button" id="increase" value="Increase Value">+</div></div>' : ' <div class="quantity"><div class="value-button" id="decrease" value="Decrease Value">-</div><input type="number" id="number" class="input" value="1" /><div class="value-button" id="increase" value="Increase Value">+</div></div>'; // end Quantity input

        // button input
        $button = isset($params['btn']) ? '<button type="submit" id="update"><img src="asset/img/loader.svg" alt="" srcset="">'. $params['btn'] . '</button>' : ' <button type="submit" id="add"><img src="asset/img/loader.svg" alt="" srcset="">Add to Tray</button>'; // end button input
        
        

        $html = <<<HTML
                <form action="" method="post" id="form_options">
                    <label for="size">Choose your Plate size</label>
                    <div style="margin-bottom: 10px; position: relative;">
                        <i class="fas fa-angle-down"></i>
                        <!-- <input type="text" name="size" class="input-text input" placeholder="Choose your size" data-listen="input" autocomplete="off" readonly="" data-required-validate="true" id="size" value=""> -->
                        $size
                     
                        <ul class="[ u-df-mb u-df-mb-fd-c ]">
                            <li class="[ u-df-mb ] " data-combination-value="2205-6846" data-select-value="Regular" data-price-value="210" data-product="14233">
                                <div class="o-form-dropdown_input--item [ u-df-mb u-df-mb-fd-c u-df-mb-jc-c ]">
                                    <h5 class="h5">Solo</h5> 
                                    <div class="o-form-dropdown_input--item__subdetail [ u-df-mb ]">
                                        <span>Php 210.00</span>
                                    </div>
                                </div>
                            </li>
                            <li class="[ u-df-mb ] " data-combination-value="2205-6847" data-select-value="Large" data-price-value="380" data-product="14233">
                                <div class="o-form-dropdown_input--item [ u-df-mb u-df-mb-fd-c u-df-mb-jc-c ]">
                                    <h5 class="h5">Platter</h5> 
                                    <div class="o-form-dropdown_input--item__subdetail [ u-df-mb ]">
                                        <span>Php 380.00</span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                
                    <label for="Instruction">Special Instruction (optional)</label>
                    <!-- <textarea name="Instruction" id="Instruction" class="input" placeholder="Add Special Instruction here"></textarea> -->
                    $instruction

                    <label for="number">Quantity</label>
                    <!-- <div class="quantity">
                        <div class="value-button" id="decrease" value="Decrease Value">-</div>
                        <input type="number" id="number" class="input" value="1" />
                        <div class="value-button" id="increase" value="Increase Value">+</div>
                    </div> -->
                    $quantity 
                    <!-- <button type="submit">
                        <img src="asset/img/loader.svg" alt="" srcset="">
                        Add to Tray
                    </button> -->
                    $button
                </form>
        HTML;
        return $html;
    }

    private function renderChicken(): string
    {
        $html = <<<HTML
                <form action="" method="post" id="form_options">
                    <label for="size">Choose your Plate size</label>
                    <div style="margin-bottom: 10px; position: relative;">
                        <i class="fas fa-angle-down"></i>
                        <input type="text" name="size" class="input-text input" placeholder="Choose your size" data-listen="input" autocomplete="off" readonly="" data-required-validate="true" id="size">
                        <ul class="[ u-df-mb u-df-mb-fd-c ]">
                            <li class="[ u-df-mb ] " data-combination-value="2205-6846" data-select-value="Regular" data-price-value="210" data-product="14233">
                                <div class="o-form-dropdown_input--item [ u-df-mb u-df-mb-fd-c u-df-mb-jc-c ]">
                                    <h5 class="h5">Solo</h5> 
                                    <div class="o-form-dropdown_input--item__subdetail [ u-df-mb ]">
                                        <span>Php 210.00</span>
                                    </div>
                                </div>
                            </li>
                            <li class="[ u-df-mb ] " data-combination-value="2205-6847" data-select-value="Large" data-price-value="380" data-product="14233">
                                <div class="o-form-dropdown_input--item [ u-df-mb u-df-mb-fd-c u-df-mb-jc-c ]">
                                    <h5 class="h5">Platter</h5> 
                                    <div class="o-form-dropdown_input--item__subdetail [ u-df-mb ]">
                                        <span>Php 380.00</span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <label for="Instruction">Special Instruction (optional)</label>
                    <textarea name="Instruction" id="Instruction" class="input" placeholder="Add Special Instruction here"></textarea>

                    <label for="number">Quantity</label>
                    <div class="quantity">
                        <div class="value-button" id="decrease" value="Decrease Value">-</div>
                        <input type="number" id="number" class="input" value="1" />
                        <div class="value-button" id="increase" value="Increase Value">+</div>
                    </div>
                    <button type="submit">
                        <img src="asset/img/loader.svg" alt="" srcset="">
                        Add to Tray
                    </button>
                </form>
        HTML;
        return $html;
    }

    private function renderDrink(): string
    {
        $html = <<<HTML
                <form action="" method="post" id="form_options">
                    <label for="Instruction">Special Instruction (optional)</label>
                    <textarea name="Instruction" id="Instruction" class="input" placeholder="Add Special Instruction here"></textarea>

                    <label for="number">Quantity</label>
                    <div class="quantity">
                        <div class="value-button" id="decrease" value="Decrease Value">-</div>
                        <input type="number" id="number" class="input" value="1" />
                        <div class="value-button" id="increase" value="Increase Value">+</div>
                    </div>
                    <button type="submit">
                        <img src="asset/img/loader.svg" alt="" srcset="">
                        Add to Tray
                    </button>
                </form>
        HTML;
        return $html;
    }

}



