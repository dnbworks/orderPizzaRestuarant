<?php

namespace app\controllers;

use app\core\cart\Cart;
use app\core\cart\Product;
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
        // session_start();
        header('Access-control-Allow-Origin: *');
        header('Content-type: application/json');
        header('Access-Control-Allow-Methods: POST');
        header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Access-Control-Allow-Headers, Access-Control-Allow-Methods, Authorization, X-Requested-With');

        // get the raw posted data
        
        $data = json_decode(file_get_contents("php://input"));
        $data[0]->id;

        $array_options = [];
        foreach((array) $data as $option){
            $array_options[$option->option] = $option->value;
        }


        $pizzaModel = new PizzaModel();
        $item = $pizzaModel->getById((int)$data[0]->id);

        $product = new Product($item[0]['product_id'], $item[0]['title'], $item[0]['price'], 10, $array_options, $item[0]['img']);

        $cart = $_SESSION['cart'];

        $cart->addProduct($product, 1);

        if($data) {
            echo json_encode(
                array('message' => 'Post Created', 'data' =>  $product->getProduct(), 'options' => $array_options, 'num_of_cart_items' => $_SESSION['cart']->getTotalQuantity(), 'cart' => $_SESSION['cart']->getItems(), 'item' => $_SESSION['cart']->getItems()[$data[0]->id]->itemSummary())
            );
            } else {
            echo json_encode(
                array('message' => 'Post Not Created')
            );
        }
        // var_dump($data);
               
    }
  
}

