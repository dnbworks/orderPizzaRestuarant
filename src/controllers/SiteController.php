<?php
 
namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\core\middleware\AuthMiddleware;
use app\models\UserModel;
use app\models\QuestionModel;
use app\models\MismatchModel;
use app\models\UpdateProfileModel;
use app\models\PizzaModel;


class SiteController extends Controller {

    public function __construct()
    {
        if(Application::IsGuest()){
            $this->setLayout('error');
        } 
        // add middleware to certain pages
        $this->registerMiddleware(new AuthMiddleware(['edit', 'home', 'questionaire', 'profile', 'mismatch']));
    }
    // serves the landing page
    public function index(Request $request, Response $response){
        if(!Application::IsGuest()){
            $response->redirect('/home');
            exit;
        }
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
    public function order(Request $request){
        $PizzaModel = new PizzaModel();
        $this->setLayout('main');

        if(isset($request->getBody()['type']) && isset($request->getBody()['name']) && (!empty($request->getBody()['name'])) && (!empty($request->getBody()['type']))){
            $result = $PizzaModel->findOne($request->getBody()['type'], $request->getBody()['name']);
            return $this->render('meal', [
                'pizza' => $result[0],
                'status' =>  'show'
            ]);
        }
     
        $result = $PizzaModel->offer();

        return $this->render('order', [
            'pizzas' => $result['data']
        ]);
    }

    public function checkout(Response $response)
    {
        if(!Application::IsGuest()){
            $response->redirect('/account');
            exit;
        } 
       
        $this->setLayout('main');
        return $this->render('checkout');
    }

    public function viewProduct()
    {  
        return $this->render('meal');
    }

    public function editProduct(Request $request)
    {  
        $this->setLayout('main');
        $PizzaModel = new PizzaModel();
        if(isset($request->getBody()['id']) && isset($request->getBody()['name'])){
            $result = $PizzaModel->getById($request->getBody()['id']);
            $items = $_SESSION['cart']->getItems();
            $item = array_filter($items, fn($item) => $item->itemSummary()['id'] == $request->getBody()['id']);
            
            // echo '<pre>';
            // var_dump( $item[$request->getBody()['id']]->itemSummary()['options']);
            // echo '</pre>';
            // exit;

            // echo '<pre>';
            // var_dump( $result);
            // echo '</pre>';
            // exit;
          
            return $this->render('meal', ['pizza' => $result[0], 'status' =>  'update', 'options' => $item[$request->getBody()['id']]->itemSummary()['options']]);
        }
    }

    public function account()
    {
        $this->setLayout('main');
        return $this->render('account');
    }

    public function cart()
    {
        $cart = $_SESSION['cart'];
        $this->setLayout('main');
        return $this->render('cart', ['cart' => $cart]);
    }

    public function home(){
        $this->setLayout('main');
        $UserModel = new UserModel();
        $QuestionModel = new QuestionModel();

        $count = $QuestionModel::getQuestions([
            'user_id' => Application::$app->user->user_id
        ])['responseCount'];

        $users = $UserModel::findAll();
      
        return $this->render('home', [
            'users' => $users,
            'responseCount' => $count
        ]);
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

    public function questionaire(Request $request)
    {
        $this->setLayout('main');

        $QuestionModel = new QuestionModel();
        $responses = $QuestionModel::getQuestions([
            'user_id' => Application::$app->user->user_id
        ])['responses'];

        if($request->isPost()){
            // $QuestionModel->loadData($request->getBody());

            if($QuestionModel->register()){
                Application::$app->session->setFlash("success", "Your responses have been saved. ");
                Application::$app->response->redirect("/questionaire");

            }

            return $this->render('questionaire', ["responses" => $responses ]);
        }

        
        return $this->render('questionaire', ["responses" => $responses ]);
    }

    public function profile(Request $request, Response $response)
    {   
     
        $UserModel = new UserModel();
        $user = $UserModel::findOne([
            'user_id' => $request->getBody()['id'] ?? Application::$app->user->user_id
        ]);

        $this->setLayout('main');
        return $this->render('view-profile', [
            'user' => $user
        ]);
    }

    public function mismatch()
    {
        $mismatchModel = new MismatchModel();

        $data = $mismatchModel::fetchResponse();
        $this->setLayout('main');

        if(isset($data['errors'])){
            return $this->render('mismatch', [
                'errors' => $data['errors']
            ]);
            // echo '<pre>';
            // var_dump( $data);
            // echo '</pre>';
            // // echo $data;
            exit;
        }
        
        return $this->render('mismatch', [
            'user' => $data['user'][0],
            'topics' => $data['topics'],
        ]);
    }

    
}




