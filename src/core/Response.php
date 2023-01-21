<?php

namespace app\core;

class Response {
    
    public function setStatusCode(int $code){
        http_response_code((int) $code);
    }

    public function redirect($url, $param = [])
    {
        Application::$app->session->setFlash("order_details", $param);
        header("Location: $url");
    }

    
}