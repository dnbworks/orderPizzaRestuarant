<?php 

namespace app\core;

use app\core\cart\Cart;

class Session {

   protected const FLASH_KEY = 'flash_messages';

   public function __construct()
   {
       session_start();
       $flashMessages = $_SESSION[self::FLASH_KEY] ?? [];
       // modify the array key avlues
       foreach ($flashMessages as $key => &$flashMessage) {
           $flashMessage['remove'] = true;
       }
       $_SESSION[self::FLASH_KEY] = $flashMessages;  

       if(!isset($_SESSION['cart'])){
            $_SESSION['cart'] = new Cart;
            $_SESSION['cart_counter'] = 0;
       }
        
   }


   public function setFlash($key, $message)
   {
       $_SESSION[self::FLASH_KEY][$key] = [
           'remove' => false,
           'value' => $message
       ];
   }

   public function getFlash($key)
   {
       return $_SESSION[self::FLASH_KEY][$key]['value'] ?? false;
   }

   public function set($key, $value)
   {
       $_SESSION[$key] = $value;
   }

   public function get($key)
   {
       return $_SESSION[$key] ?? false;
   }

   public function remove($key)
   {
      unset($_SESSION[$key]);
   }

   public function __destruct()
   {
        $flashMessages = $_SESSION[self::FLASH_KEY] ?? [];
      
        foreach ($flashMessages as $key => &$flashMessage) {
            if($flashMessage['remove']){
                unset($flashMessages[$key]);
            }
            
        }
        $_SESSION[self::FLASH_KEY] = $flashMessages;  
   }

}