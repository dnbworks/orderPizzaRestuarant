<?php

$cart = [
    '1' => [],
    '2' => ''
];

unset($cart['1']);
var_dump($cart);