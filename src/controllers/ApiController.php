<?php

// declare(strict_types = 1);

namespace app\controllers;

use app\core\cart\Cart;
use app\core\cart\Product;
use app\core\Controller;
use app\core\Request;
use app\models\PizzaModel;
use app\helpers\PaginationLinks;


class ApiController extends Controller
{
    public static int $counter = 0;
    public function type(Request $request)
    {
        header('Access_control-Allow_origin: *');
        header('Content-type: application/json');

        $PizzaModel = new PizzaModel();
        $this->setLayout('main');

        if(isset($request->getBody()['type'])){

            $current_page = isset($request->getBody()['page']) ? $request->getBody()['page'] : 1;
            $result_per_page = 6;

            $skip = (($current_page - 1) * $result_per_page);

            $result = $PizzaModel->getType($request->getBody()['type']);

            $rowCount = count($result['data']);
            $num_pages = ceil($rowCount / $result_per_page);

            $limit = " LIMIT $skip,  $result_per_page";

            $result = $PizzaModel->getType($request->getBody()['type'],  $limit);

            if($num_pages > 1){
                // generate pagination links
                $pagination = new PaginationLinks($current_page, $num_pages, $request->getBody()['type']);
                $links = $pagination->generate_page_links();
            } else {
                $links = '';
            }


            return json_encode(
                    array('pagination_links' => $links, 'data' => $result['data'])
                );
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
        $_SESSION['cart_counter']++;
        self::$counter++;
        if($data) {
            echo json_encode(
                array('message' => 'Post Created', 'data' =>  $product->getProduct(), 'counter' => $_SESSION['cart_counter'], 'cartNum' =>  $_SESSION['cart']->getTotalQuantity())
            );
            } else {
            echo json_encode(
                array('message' => 'Post Not Created')
            );
        }
        // var_dump($data);
               
    }

    public function update()
    {
        header('Access-control-Allow-Origin: *');
        header('Content-type: application/json');
        header('Access-Control-Allow-Methods: POST');
        header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Access-Control-Allow-Headers, Access-Control-Allow-Methods, Authorization, X-Requested-With');

        $data = json_decode(file_get_contents("php://input"));
        $data[0]->id;

        $array_options = [];
        foreach((array) $data as $option){
            $array_options[$option->option] = $option->value;
        }

        // get the session cart
        $cart = $_SESSION['cart'];
        // remove item
        $cart->removeItem($data[0]->id);

        $pizzaModel = new PizzaModel();
        $item = $pizzaModel->getById((int)$data[0]->id);

        $product = new Product($item[0]['product_id'], $item[0]['title'], (float) $item[0]['price'], 10, $array_options, $item[0]['img'], $item[0]['category']);

        // add the updated version of the item
        $cart->addProduct($product, (int)$array_options['number']);

        // update product goal minimalist code
        // $_SESSION['cart']->getItems()[$data[0]->id]->itemSummary()['options'] = $array_options;
        if($data) {
            echo json_encode(
                array('message' => 'updated Created', 'data' =>  $data, 'counter' => $_SESSION['cart_counter'], 'cartNum' =>  $_SESSION['cart']->getTotalQuantity(), 'item' => $_SESSION['cart']->getItems()[$data[0]->id]->itemSummary()['options'], 'option' => $array_options)
            );
        } else {
            echo json_encode(
                array('message' => 'Post Not Created')
            );
        }
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
        foreach($items as $item){
            $cartItems[] = $item->itemSummary();
        }

        if($data) {
            echo json_encode(
                array('message' => 'removed item', 'data' =>  $data, 'cart' =>$cartItems, 'subtotal' => $_SESSION['cart']->getTotalSum(), 'cartNum' => $_SESSION['cart']->getTotalQuantity())
            );
            } else {
            echo json_encode(
                array('message' => 'Post Not Created')
            );
        }
    }
  
}

