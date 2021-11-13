<?php

namespace app\libs;

final class Captcha 
{
    public const CAPTCHA_NUMCHARS = 6;
    public const CAPTCHA_WIDTH = 100;
    public const CAPTCHA_HEIGHT = 26;

    public string $pass_phrase = "";

    private static $instance = null;
    private function __clone(){}

    private static function init(){
        if(is_null(self::$instance)){
            self::$instance = new self();
        }
        return self::$instance;
    }

    public static function generateCaptcha()
    {
        self::init();

        for ($i=0; $i < self::CAPTCHA_NUMCHARS; $i++) { 
            Captcha::$instance->pass_phrase .= chr(rand(97, 122));
        }
        
        $_SESSION['pass_phrase'] = sha1(Captcha::$instance->pass_phrase);

        $img = imagecreatetruecolor(self::CAPTCHA_WIDTH, self::CAPTCHA_HEIGHT);

        $bg_color = imagecolorallocate($img, 255, 255, 255);
        $text_color = imagecolorallocate($img, 0, 0, 0);
        $graphic_color = imagecolorallocate($img, 204, 204, 133);

        // fill the background
        imagefilledrectangle($img, 0, 0, self::CAPTCHA_WIDTH, self::CAPTCHA_HEIGHT, $bg_color);

        for ($i=0; $i < 50; $i++) { 
            imageline($img, 0, rand() % self::CAPTCHA_HEIGHT, self::CAPTCHA_WIDTH, rand() % self::CAPTCHA_HEIGHT, $graphic_color);
        }
    
        // sprinkle in some random dots
        for ($i=0; $i < 50; $i++) { 
            imagesetpixel($img, rand() % self::CAPTCHA_WIDTH, rand() % self::CAPTCHA_HEIGHT, $graphic_color);
        }
    
        // draw the pass-phrase string
        imagettftext($img, 18, 0, 5, self::CAPTCHA_HEIGHT - 5, $text_color, "asset/fonts/OpenSans-Regular.ttf", Captcha::$instance->pass_phrase);
    
        header("Content-Type: image/png");
    
        imagepng($img);
    
        //clean up 
        imagedestroy($img);
    }
}