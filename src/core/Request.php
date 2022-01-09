<?php

namespace app\core;

class Request {
    
    public function getPath(){
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $position = strpos($path, '?');

        if($position !== false){
            return substr($path, 0, $position);
        }

        return $path;
    }

    public function getMethod()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function isGet(){
        return $this->getMethod() === 'get';
    }

    public function isPost(){
        return $this->getMethod() === 'post';
    }


    public function getBody(){
        $path = $_SERVER['REQUEST_URI'];

        $position = strpos($path, '?');

        if($position !== false){
            $path = substr($path, $position + 1);
        }



        $uriParams = $this->explodeUri($path);

        $formatedArr = [];

        $body = [];

        if($this->getMethod() === "get"){
            foreach($uriParams as $key => $value){
                // $body[$key] = filter_input(INPUT_GET, $value, FILTER_SANITIZE_SPECIAL_CHARS);
                $body[$key] =  filter_var($value, FILTER_SANITIZE_SPECIAL_CHARS);
             
            }
        }

        if($this->getMethod() === "post"){
            foreach($formatedArr as $key => $value){
                $body[$key] = filter_input(INPUT_POST, $value, FILTER_SANITIZE_SPECIAL_CHARS);       
            }
        }

        // if($this->getMethod() === "get"){
        //     foreach($_GET as $key => $value){
        //         $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
        //     }
        // }

        // if($this->getMethod() === "post"){
        //     foreach($_POST as $key => $value){
        //         $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);       
        //     }
        // }
        
        return $body;
    }

    private function explodeUri(string $uriParams): array
    {
        $paramArr = [];
        if(strpos($uriParams, '&') !== false){
            $paramArr = explode('&', $uriParams);

        }
        $formatedArr = [];

        if(count($paramArr) > 0){
            foreach($paramArr as $param){
                $paramKeysPairs = explode('=',$param);
                $formatedArr[$paramKeysPairs[0]] = $paramKeysPairs[1];
            }
            return $formatedArr;
        }

        $paramKeysPairs = explode('=',$uriParams);
        $formatedArr[$paramKeysPairs[0]] = $paramKeysPairs[1];

        return $formatedArr;
    }
}