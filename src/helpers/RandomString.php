<?php

namespace app\helpers;

class RandomString {

    private static $instance = null;
    private function __clone(){}

    private static function init(){
        if(is_null(self::$instance)){
            self::$instance = new self();
        }
        return self::$instance;
    }

    public static function rand(int $n): string
    {
        self::init();

        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $str = '';
        for ($i = 0; $i < $n; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $str .= $characters[$index];
        }

        return $str;
    }
}