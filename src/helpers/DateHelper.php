<?php 

namespace app\helpers;

final class DateHelper 
{
    private static $instance = null;
    private function __clone(){}

    private static function init(){
        if(is_null(self::$instance)){
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function FormatMonth($NumericMonth):string 
    {
        $str_month = '';
        switch ($NumericMonth) {
            case 1:
                $str_month = 'January';
                break;
            case 2;
                $str_month = 'February';
                break;
            case 3:
                $str_month = 'March';
                break;
            case 4:
                $str_month = 'April';
                break;
            case 5:
                $str_month = 'May';
                break;
            case 6:
                $str_month = 'June';
                break;
            case 7:
                $str_month = 'July';
                break;
            case 8:
                $str_month = 'August';
                break;
            case 9:
                $str_month = 'September';
                break;
            case 10:
                $str_month = 'October';
                break;
            case 11:
                $str_month = 'November';
                break;
            case 12:
                $str_month = 'December';
                break;
        }
        return $str_month;
    }

    public static function format_data($date)
    {
        self::init();

        $full_date_array = explode(' ', $date)[0];
        $date_array = explode('-', $full_date_array);
        $year = $date_array[0];
        $month = $date_array[1];
        $day = $date_array[2];
        return self::$instance->FormatMonth($month) . ' ' . $day . ', ' . $year ;
    }
}