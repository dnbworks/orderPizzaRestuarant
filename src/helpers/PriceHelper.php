<?php 

namespace app\helpers;

final class PriceHelper 
{
    private static $instance = null;
    private function __clone(){}

    private static function init(){
        if(is_null(self::$instance)){
            self::$instance = new self();
        }
        return self::$instance;
    }

    public static function formatMoney(float|int $price): float|string
    {
        self::init();
        $position = strpos((string) $price, '.');

        if($position){
            $decimal_amount = explode('.', $price);
            $price = $decimal_amount[1];
            $decimal_lenght = strlen($price);
            return  $decimal_amount[0] . '.' .self::addZero($decimal_lenght, $price);
            exit;
        }
        return $price . '.00';
    }

    private static function addZero($param, $price): string
    {
        if($param == 1){
            return $price = '0' . $price;
            exit;
        }
        return $price;
    }
}