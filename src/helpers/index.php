<?php

require 'PriceHelper.php';
require 'RandomString.php';
require 'DateHelper.php';



// var_dump(app\helpers\PriceHelper::formatMoney(34.7));
// var_dump(app\helpers\PriceHelper::formatMoney(34.01));
// var_dump(app\helpers\PriceHelper::formatMoney(34));

// echo app\helpers\RandomString::rand(3);

use app\helpers\DateHelper;


echo DateHelper::format_data('2021-11-08 23:35:57');

// var_dump(DateHelper::format_data('2021-11-08 23:35:57'));
