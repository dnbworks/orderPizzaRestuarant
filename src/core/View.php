<?php

namespace app\core;

class View {
    public string $title = "";

    public function renderView($view, $params = []){
 
        $content = $this->renderContent($view, $params);
        $layout = $this->renderLayout();
   

        return str_replace("{{content}}", $content, $layout);
    }

    protected function renderLayout(){
        $layoutName = Application::$app->layout;
        if (Application::$app->controller) {
            $layoutName = Application::$app->controller->layout;
        }
  
        ob_start();
        include_once Application::$ROOT_DIR . "/src/views/layouts/$layoutName.php";
        return ob_get_clean();
    }

    protected function renderContent($view, $params){

        foreach($params as $key => $value){
            $$key = $value;
        }

        ob_start();
        include_once Application::$ROOT_DIR . "/src/views/$view.php";
        return ob_get_clean();
    }
}

