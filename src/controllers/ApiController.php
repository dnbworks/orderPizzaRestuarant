<?php

// declare(strict_types = 1);

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

        $product = new Product($item[0]['product_id'], $item[0]['title'], (float) $item[0]['price'], 10, $array_options, $item[0]['img'], $item[0]['category']);

        $cart = $_SESSION['cart'];

        $cart->addProduct($product, (int)$array_options['number']);

        if($data) {
            echo json_encode(
                array('message' => 'Post Created', 'data' =>  $product->getProduct())
            );
            } else {
            echo json_encode(
                array('message' => 'Post Not Created')
            );
        }
        // var_dump($data);
               
    }

    public function upadte()
    {

    }

    public function delete()
    {
        header('Access-control-Allow-Origin: *');
        header('Content-type: application/json');
        header('Access-Control-Allow-Methods: POST');
        header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Access-Control-Allow-Headers, Access-Control-Allow-Methods, Authorization, X-Requested-With');

        $data = json_decode(file_get_contents("php://input"));

        $cart = $_SESSION['cart'];

        $cart->removeItem($data);

        $cartItems = [];
        $items = $_SESSION['cart']->getItems();
        foreach($items as $key => $item){
            $cartItems[] = $item->itemSummary();
        }

        if($data) {
            echo json_encode(
                array('message' => 'removed item', 'data' =>  $data, 'cart' =>$cartItems)
            );
            } else {
            echo json_encode(
                array('message' => 'Post Not Created')
            );
        }
    }
  
}

