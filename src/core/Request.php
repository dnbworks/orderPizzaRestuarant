<?php

declare(strict_types=1);

namespace app\core;

class Request {
    
    /**
     * grabs the request uri and trims off the search params
     *
     * @return string
     */
    public function getPath(): string
    {
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $position = strpos($path, '?');

        if($position !== false){
            return substr($path, 0, $position);
        }
        return $path;
    }

    /**
     * turns the request method to lowercase
     *
     * @return string
     */
    public function getMethod(): string
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    /**
     * checks whether the request method is a get request
     *
     * @return bool
     */
    public function isGet(): bool
    {
        return $this->getMethod() === 'get';
    }

    /**
     * checks whether the request method is a post request
     *
     * @return bool
     */
    public function isPost(): bool
    {
        return $this->getMethod() === 'post';
    }

    /**
     * Sanitize class
     * Global sanitization and filtering. Uses native PHP filtering. 
     *
     * @return array
     * 
     */
    public function getBody(): array
    {
        $path = $_SERVER['REQUEST_URI'];
        $position = strpos($path, '?');
        $formatedArr = [];
        $body = [];

        if($position !== false){
            $path = substr($path, $position + 1);
            
            $uriParams = $this->explodeUri($path);
            // var_dump($uriParams);
            // exit;

            if($this->getMethod() === "get"){
                foreach($uriParams as $key => $value){
                    $body[$key] =  filter_var($value, FILTER_SANITIZE_SPECIAL_CHARS);
                }
            }
    
          
        }

        if($this->getMethod() === "post"){
            foreach($_POST as $key => $value){
                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);       
            }
        }
        

       

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

        if(strpos($uriParams, '=') !== false){
            $paramKeysPairs = explode('=',$uriParams);
            $formatedArr[$paramKeysPairs[0]] = $paramKeysPairs[1];
        }

        return $formatedArr;
    }
}