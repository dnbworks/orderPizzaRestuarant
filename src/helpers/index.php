<?php

require 'PriceHelper.php';

var_dump(app\helpers\PriceHelper::formatMoney(34.7));
var_dump(app\helpers\PriceHelper::formatMoney(34.01));
var_dump(app\helpers\PriceHelper::formatMoney(34));