<?php

declare(strict_types = 1);

namespace app\core;

use app\core\exception\NotFoundException;
use app\core\Response;

class Router {

    protected array $routes = [];
    public Request $request;
    public Response $response;

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function get($path, $callback): void
    {
        $this->routes['get'][$path] = $callback;
    }

    public function post($path, $callback): void
    {
        $this->routes['post'][$path] = $callback;
    }

    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();
    

        if(count(explode('/', $path)) > 2){
            if(explode('/', $path)[2] == "view-order" && (isset(explode('/', $path)[3]) && !empty(explode('/', $path)[3]))){
                $param = substr($path, -1);
                $defined_path = substr($path, 0,-1) . ':id';
                $callback = $this->routes[$method][$defined_path] ?? false;
    
            }
        }
          
        $newPath = $defined_path ?? $path;
        $param = $param ?? null;

        $callback = $this->routes[$method][$newPath] ?? false;
        

        if($callback === false){
            throw new NotFoundException();
        }

        if(is_string($callback)){
            return Application::$app->view->renderView($callback);
        }

        if(is_array($callback)){
          
            $controller = new $callback[0]();
            Application::$app->controller =  $controller;
            $controller->action = $callback[1];
            $callback[0] = $controller;

            foreach($controller->getMiddlewares() as $middleware){
                $middleware->execute();
            }
        }
    
        return call_user_func($callback, $this->request, $this->response, $param);
     
    }

}