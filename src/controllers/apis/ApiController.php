<?php


namespace app\controllers\apis;

use app\core\cart\Product;
use app\core\Controller;
use app\core\Request;
use app\models\PizzaModel;
use app\helpers\PaginationLinks;
use app\helpers\RandomString;



class ApiController extends Controller
{

    public function type(Request $request)
    {
        header('Access_control-Allow_origin: *');
        header('Content-type: application/json');

        $PizzaModel = new PizzaModel();
        // $this->setLayout('main');
        
        if(isset($request->getBody()['type'])){
           
            $current_page = isset($request->getBody()['page']) ? $request->getBody()['page'] : 1;
            $result_per_page = 6;

            $skip = (($current_page - 1) * $result_per_page);

            $result = $PizzaModel->getType($request->getBody()['type']);

            $rowCount = count($result['data']);
            $num_pages = ceil($rowCount / $result_per_page);

            $limit = " LIMIT $skip,  $result_per_page";

            $result = $PizzaModel->getType(preg_replace('/%20/', ' ', $request->getBody()['type']),  $limit);
            
        
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

        $cart = $_SESSION['cart']; // call the cart session

        $pizzaModel = new PizzaModel(); // instantiate Pizza model
        $item = $pizzaModel->getById((int)$data[0]->id); // get item from db by id

        $cartItemId = RandomString::rand(3); // generate a random cartitemid string to uniquely identify items in the cart
    
        $is_product_in_cart = isset($cart->getItems()[$cartItemId]) ?? false;

        if(!$is_product_in_cart){
            $product = new Product($item[0]['product_id'], $item[0]['title'], (float) $item[0]['price'], 10, $array_options, $item[0]['img'], $item[0]['category'], $item[0]['description'], $cartItemId);

            $cart->addProduct($product, (int)$array_options['number']);
        }

        $_SESSION['cart_counter']++;

        if($data) {
            echo json_encode(
                array('message' => 'item add to cart', 'data' =>  $product->getProductAttributes(), 'counter' => $_SESSION['cart_counter'], 'cartNum' =>  $_SESSION['cart']->getTotalQuantity())
            );
            } else {
            echo json_encode(
                array('message' => 'Post Not Created')
            );
        }          
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


        $item = $_SESSION['cart']->getItems()[$data[0]->id]->getProduct()->getProductAttributes();


        $product = new Product($item['id'], $item['title'], (float) $item['price'], $item['availableQuantity'], $array_options, $item['img'], $item['category'], $item['description'], $item['CartItemId']);

        // update the product
        $cart->updateProduct($data[0]->id, $product, (int)$array_options['number']);
  

        if($data) {
            echo json_encode(
                array('message' => 'updated Created', 'data' =>  $data, 'counter' => $_SESSION['cart_counter'], 'cartNum' =>  $_SESSION['cart']->getTotalQuantity(), 'item' => $_SESSION['cart']->getItems()[$data[0]->id]->getProduct()->getProductAttributes(), 'option' => $array_options, 'cartItems' => $cart->getItems())
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
            $cartItems[] = $item->getProduct()->getProductAttributes();
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

    public function renderForm(Request $request)
    {
        if(isset($request->getBody()['status']) && isset($request->getBody()['category'])){
            $htmlForm = '';

            if($request->getBody()['status'] == 'addDiff'){
                $htmlForm = \app\core\Application::$app->render->renderHtml($request->getBody()['category'], ['btn' => 'Add To Tray']);
            } else {
                $items = $_SESSION['cart']->getItems()[$request->getBody()['cartItemId']]->getProduct()->getProductAttributes()['options'];
               
                $htmlForm = \app\core\Application::$app->render->renderHtml($request->getBody()['category'], ['btn' => 'Update Order', 'options' => $items]);
            }

            return json_encode(
                array('message' => 'listened to api', 'form' => $htmlForm, 'category' => $request->getBody()['category'], 'cartId' => $request->getBody()['cartItemId'])
            );
                
        }
    
        
    }

    public function checkoutForm(Request $request)
    {
        header('Access_control-Allow_origin: *');
        header('Content-type: application/json');

        if(isset($request->getBody()['method'])){
            $htmlForm = '';

            if($request->getBody()['method'] == 'pickup'){
                $htmlForm = \app\core\Application::$app->render->renderHtml($request->getBody()['method']);
            } else {
               
                $htmlForm = \app\core\Application::$app->render->renderHtml($request->getBody()['method']);
            }

            return json_encode(
                array('message' => 'listened to api', 'form' => $htmlForm, 'method' => $request->getBody()['method'])
            );
                
        }
     
        
    }
  
}





