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

    public function post()
    {
        header('Access-control-Allow-Origin: *');
        header('Content-type: application/json');
        header('Access-Control-Allow-Methods: POST');
        header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Access-Control-Allow-Headers, Access-Control-Allow-Methods, Authorization, X-Requested-With');

        // get the raw posted data

        $data = json_decode(file_get_contents("php://input"));
        $_SESSION['cart'][] = $data;

        if($data) {
            echo json_encode(
                array('message' => 'Post Created', 'data' => $data)
            );
            } else {
            echo json_encode(
                array('message' => 'Post Not Created')
            );
        }
        // var_dump($data);
     
                
    }
  
}

