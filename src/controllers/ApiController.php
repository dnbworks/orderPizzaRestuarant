<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;
use app\models\PizzaModel;


class ApiController extends Controller
{

    public function type(Request $request)
    {
        header('Access_control-Allow_origin: *');
        header('Content-type: application/json');

        $PizzaModel = new PizzaModel();
        $this->setLayout('main');

        if(isset($request->getBody()['type'])){
       
            $result = $PizzaModel->getType($request->getBody()['type']);

            return json_encode($result);
        }
     
    }
  
}

