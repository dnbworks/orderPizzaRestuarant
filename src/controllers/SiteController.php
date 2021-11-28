<?php
 
namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\core\middleware\AuthMiddleware;
use app\models\PizzaModel;
use app\libs\Captcha;
use app\models\UserModel;

class SiteController extends Controller 
{

    public function __construct()
    {
        // add middleware to certain pages
        $this->registerMiddleware(new AuthMiddleware(['edit', 'dashboard']));
    }
    // serves the landing page
    public function index(Request $request, Response $response)
    {

        $this->setLayout('landingLayout');
        return $this->render('index');
    }
    // serves the about page
    public function about()
    {
        $this->setLayout('main'); // sets the layout template to be main layout
        return $this->render('about'); // renders the about page with its template
    }
    // serves the order page
    public function order(Request $request)
    {
        $PizzaModel = new PizzaModel();
        $this->setLayout('main');

        if(isset($request->getBody()['type']) && isset($request->getBody()['name']) && (!empty($request->getBody()['name'])) && (!empty($request->getBody()['type']))){

            $result = $PizzaModel->findOne($request->getBody()['type'], $request->getBody()['name']);

            $cart = $_SESSION['cart']->getItems();

            $keyId = [];

            foreach($cart as $key => $item){
                if($item->getProduct()->getId() == $result[0]['product_id']){
                    $keyId[] = $key;
                }
            }

            if(count($keyId) == 1){
                $item = $cart[$keyId[0]];

                return $this->render('meal', 
                    [
                        'pizza' => $result[0],
                        'status' =>  'show',
                        'isCart' => true,
                        'options' => $item->getProduct()->getProductAttributes()['options'],
                        'item' => $item->getProduct()->getProductAttributes()
                    ]
                );
                exit;
                
            } else if(count($keyId) > 1){

                $optionList = [];

                foreach($cart as $key => $item){
                    $optionList[$key] = $item->getProduct()->getProductAttributes()['options'];
                }

                return $this->render('meal', 
                    [
                        'pizza' => $result[0],
                        'status' =>  'show',
                        'isCart' => true,
                        'options' => $item->getProduct()->getProductAttributes()['options'],
                        'optionList' => $optionList,
                        'item' => $item->getProduct()->getProductAttributes()
                    ]
                );
                exit;

            } else {
                return $this->render('meal', [
                    'pizza' => $result[0],
                    'status' =>  'show',
                    'isCart' => false
                ]);
            }

            
        }
     
        $result = $PizzaModel->offer();

        return $this->render('order', [
            'pizzas' => $result['data']
        ]);
    }

    public function dashboard(Request $request, Response $response)
    {
        $this->setLayout('main');
        if(Application::IsGuest()){
            $response->redirect('/login');
            exit;
        } 
        
        return $this->render('dashboard');
    }

    public function checkout(Request $request, Response $response)
    {
        $this->setLayout('main');
        if(Application::IsGuest()){
            $_SESSION['url'] = 'checkout';
            $response->redirect('/login');
            exit;
        } 

        $cart = $_SESSION['cart'];
        $UserModel = new UserModel();
        $user = $UserModel::findOne([
            'customer_id' => $request->getBody()['id'] ?? Application::$app->user->customer_id
        ]);

        return $this->render('checkout', ['cart' => $cart, 'user' => $user]);
    }

    public function viewProduct()
    {  
        return $this->render('meal');
    }

    public function editProduct(Request $request)
    {  
        $this->setLayout('main');
        if(isset($request->getBody()['id']) && isset($request->getBody()['name'])){
            $item = $_SESSION['cart']->getItems()[$request->getBody()['id']]->getProduct()->getProductAttributes();
 
            return $this->render('meal', 
                [
                    'pizza' => $item, 
                    'status' =>  'update', 
                    'options' => $item['options']
                ]
            );
        }
    }

    public function cart()
    {
        $cart = $_SESSION['cart'];
        $this->setLayout('main');
        return $this->render('cart', ['cart' => $cart]);
    }

    public function captcha()
    {
        return Captcha::generateCaptcha();
    }

    public function place_order(Request $request, Response $response)
    {
        $sql = "";
        if(isset($request->getBody()['deliveryMethod']) && $request->getBody()['deliveryMethod'] == '1'){
           $order_id = '';
            try {
                // start transaction
                Application::$app->db->pdo->beginTransaction();
                 // strtotime();
                $sql = "INSERT INTO `orders`(`order_date`, `delivery_id`, `customer_id`, `pickup_branch_id`, `total`) VALUES (NOW(), :delivery_id, :customer_id, :branch_id, :total)";
                $statement = Application::$app->db->pdo->prepare($sql);
                $statement->bindValue(':delivery_id', $request->getBody()['deliveryMethod']);
                $statement->bindValue(':customer_id', Application::$app->user->customer_id);
                $statement->bindValue(':branch_id', $request->getBody()['branch_id']);
                $statement->bindValue(':total', \app\helpers\PriceHelper::formatMoney($_SESSION['cart']->getTotalSum()));
                $statement->execute();

                $order_id = Application::$app->db->pdo->lastInsertId();
                $order_item_query = "INSERT INTO `order_items` (`order_id`, `cart_item_id`, `product_id`, `quantity`, `addon`, `subtotal`) VALUES ";
                $values_array = [];
                foreach($_SESSION['cart']->getItems() as $item){
                    $values_array[] = "('" . Application::$app->db->pdo->lastInsertId() . "', '" . $item->getProduct()->getProductAttributes()['CartItemId'] . "', '" . $item->getProduct()->getProductAttributes()['id'] . "', '" . $item->getProduct()->getProductAttributes()['options']['number'] . "', '" . json_encode($item->getProduct()->getProductAttributes()['options']) . "', '" . \app\helpers\PriceHelper::formatMoney((float)$item->getProduct()->getProductAttributes()['price'] * (int)$item->getProduct()->getProductAttributes()['options']['number']). "')";
                }

                $final_query = $order_item_query . implode(", ", $values_array);

                // echo $final_query;
                // exit;

                $stmt = Application::$app->db->pdo->prepare($final_query);
                $stmt->execute();
                
                Application::$app->db->pdo->commit();
            } catch (\Throwable $e) {
                if(Application::$app->db->pdo->inTransaction()){
                    Application::$app->db->pdo->rollBack();
                }
            }
            
            $order_summary = "SELECT `order_id`, o.order_date, o.delivery_id, o.payment_id, o.pickup_branch_id, o.total, oi.product_id, p.img, p.title, oi.quantity, oi.subtotal FROM `orders` AS o INNER JOIN order_items AS oi USING (order_id) INNER JOIN products AS p USING (product_id) WHERE order_id = '$order_id'";
            $statement = Application::$app->db->pdo->prepare($order_summary);
            $statement->execute();
            $order_details = $statement->fetchAll();
           

            // echo '<pre>';
            // var_dump($order_details);
            // echo '</pre>';
            // exit;
            // if all transaction success then redirect to confirm info page

            // make sure cart has items to display the checkout page
            
        
            $_SESSION['cart']->setItems([]);
            $response->redirect('/order_success', $order_details);
            exit;
        } 

        if(isset($request->getBody()['deliveryMethod']) && $request->getBody()['deliveryMethod'] == '2'){
            try {
                Application::$app->db->pdo->beginTransaction();

                $sql = "INSERT INTO `orders`(`order_date`, `delivery_id`, `customer_id`, `total`) VALUES (NOW(), :delivery_id, :customer_id, :total)";
                $statement = Application::$app->db->pdo->prepare($sql);
                $statement->bindValue(':delivery_id', $request->getBody()['deliveryMethod']);
                $statement->bindValue(':customer_id', Application::$app->user->customer_id);
                $statement->bindValue(':total', \app\helpers\PriceHelper::formatMoney($_SESSION['cart']->getTotalSum()));
                $statement->execute();

                $order_item_query = "INSERT INTO `order_items` (`order_id`, `cart_item_id`, `product_id`, `quantity`, `addon`) VALUES ";
                $values_array = [];
                foreach($_SESSION['cart']->getItems() as $item){
                    $values_array[] = "('" . Application::$app->db->pdo->lastInsertId() . "', '" . $item->getProduct()->getProductAttributes()['CartItemId'] . "', '" . $item->getProduct()->getProductAttributes()['id'] . "', '" . $item->getProduct()->getProductAttributes()['options']['number'] . "', '" . json_encode($item->getProduct()->getProductAttributes()['options']) . "')";
                }

                $final_query = $order_item_query . implode(", ", $values_array);

                $stmt = Application::$app->db->pdo->prepare($final_query);
                $stmt->execute();
                
                Application::$app->db->pdo->commit();
            } catch (\Throwable $e) {
                if(Application::$app->db->pdo->inTransaction()){
                    Application::$app->db->pdo->rollBack();
                }
            }
            
    
            $_SESSION['cart']->setItems([]);    
            $response->redirect('/order_success');
        } 

    }

    public function order_success()
    {
        $order_details = null;
        if(Application::$app->session->getFlash('order_details')){
            $order_details = Application::$app->session->getFlash('order_details') ?? null;
        }

        return $this->render('confirmation_page', ['order_details' => $order_details]);
    }

}