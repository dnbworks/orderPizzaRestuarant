<?php
 
namespace app\controllers\customer;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\core\middleware\AuthMiddleware;
use app\models\UpdateProfileModel;


class CustomerController extends Controller 
{
    public function __construct()
    {
        // add middleware to certain pages
        $this->registerMiddleware(new AuthMiddleware(['edit', 'my_account', 'orders']));
    }
    public function my_account(Request $request, Response $response)
    {
        $this->setLayout('main');
        return $this->render('customer/my-account');
    }

    public function edit(Request $request)
    {
        $UserModel = new UpdateProfileModel();
        $user = $UserModel::findOne([
            'user_id' => Application::$app->user->user_id
        ]);

        if($request->isPost()){
            $UserModel->loadData($request->getBody());
            
            if($UserModel->validate()){
               
                if ($UserModel->pictureArray && $UserModel->pictureArray['tmp_name']) {
                    
                    if ($UserModel->old_image) {
                    
                        unlink(Application::$ROOT_DIR . '/public/uploads/' . $UserModel->old_image);
                    }

                    $UserModel->picture = Application::$app->user->user_id . '-' . $UserModel->picture;

                    

                    move_uploaded_file($UserModel->pictureArray['tmp_name'], Application::$ROOT_DIR . '/public/uploads/' . $UserModel->picture);

                    
                    
                    $sql = "UPDATE `mismatch_users` SET `firstname`= :firstname,`lastname`= :lastname, `gender`= :gender, `birthdate`= :birthdate, `city`= :city,`state`= :state, `picture`= :picture WHERE user_id = '" . Application::$app->user->user_id ."'";

                    $attributes = ['firstname', 'lastname', 'gender', 'birthdate', 'city', 'state', 'picture'];
                } else {
                    $attributes = ['firstname', 'lastname', 'gender', 'birthdate', 'city', 'state'];
                    $sql = "UPDATE `mismatch_users` SET `firstname`= :firstname,`lastname`= :lastname, `gender`= :gender, `birthdate`= :birthdate, `city`= :city,`state`= :state WHERE user_id = '" . Application::$app->user->user_id ."'";
                } 
                

                if($UserModel->updateProfile($attributes)){
                    Application::$app->session->setFlash("success", "Your profile has been update. ");
                    Application::$app->response->redirect("/edit-profile");
                }
            

            }

           
            return $this->render('edit-profile', ["user" => $UserModel]);
        
        }

        $this->setLayout('main');
        return $this->render('edit-profile', [
            'user' => $user
        ]);
    }

    public function orders(Request $request, Response $response)
    {
        
        $sql = "SELECT o.order_id, o.order_date, o.total, SUM(oi.quantity) AS quantity, os.name AS order_status FROM orders AS o INNER JOIN order_items AS oi USING (order_id) INNER JOIN order_statuses AS os on (order_status = os.order_status_id) WHERE customer_id = '" . Application::$app->user->customer_id . "' GROUP BY(o.order_id)";
        
        $statement = Application::$app->db->pdo->prepare($sql);
        $statement->execute();
        $orders = $statement->fetchAll();

     
        $this->setLayout('main');
        return $this->render('customer/orders', ['orders' => $orders]);
    }

    public function view_order(Request $request, Response $response, $param)
    {
        $sql = "SELECT `order_id`, o.order_date, o.delivery_id, o.payment_id, os.name AS status, o.pickup_branch_id, o.total, oi.product_id, p.img, p.title, oi.quantity, oi.subtotal, d.delivery_method FROM `orders` AS o INNER JOIN order_items AS oi USING (order_id) INNER JOIN products AS p USING (product_id) INNER JOIN order_statuses AS os ON (order_status = os.order_status_id) INNER JOIN delivery AS d USING (delivery_id) WHERE customer_id = '" . Application::$app->user->customer_id . "' AND  order_id = '" . $param . "'";

        $statement = Application::$app->db->pdo->prepare($sql);
        $statement->execute();
        $orders = $statement->fetchAll();

        // echo '<pre>';
        // var_dump($orders);
        // echo '</pre>';
        // exit;

        $this->setLayout('main');
        return $this->render('customer/view-order', ['orders' => $orders]);
    }


}

// SELECT DINSIINCT `order_id`, o.order_date, o.delivery_id, o.payment_id, os.name AS status, o.pickup_branch_id, o.total, oi.product_id, p.img, p.title, oi.quantity, oi.subtotal, d.delivery_method FROM `orders` AS o INNER JOIN order_items AS oi USING (order_id) INNER JOIN products AS p USING (product_id) INNER JOIN order_statuses AS os ON (order_status = os.order_status_id) INNER JOIN delivery AS d USING (delivery_id) WHERE customer_id = 1


// SELECT DISTINCT o.order_id, o.order_date, o.customer_id, o.total, oi.quantity FROM orders AS o INNER JOIN order_items AS oi USING (order_id) WHERE customer_id = 1

// SELECT DISTINCT o.order_id, o.order_date, o.customer_id, o.total, sum(oi.quantity) AS quantity FROM orders AS o INNER JOIN order_items AS oi USING (order_id) WHERE customer_id = 1;


// SELECT o.order_id, o.order_date, o.total, SUM(oi.quantity) AS quantity, os.name AS order_status FROM orders AS o INNER JOIN order_items AS oi USING (order_id) INNER JOIN order_statuses AS os on (order_status = os.order_status_id) WHERE customer_id = 1 GROUP BY(o.order_id)