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
        $this->registerMiddleware(new AuthMiddleware(['edit', 'home', 'questionaire', 'profile', 'mismatch']));
    }
    
    public function index(Request $request, Response $response){
        if(!Application::IsGuest()){
            $response->redirect('/home');
            exit;
        } 
       
        $this->setLayout('landingLayout');
        return $this->render('index');
    }

    public function order(Request $request){
        $PizzaModel = new PizzaModel();
        $this->setLayout('main');

        // echo $request->getBody()['type'];


        if(isset($request->getBody()['type']) && isset($request->getBody()['name']) && (!empty($request->getBody()['name'])) && (!empty($request->getBody()['type']))){

            
            $result = $PizzaModel->findOne($request->getBody()['type'], $request->getBody()['name']);
           
   
            return $this->render('meal', [
                'pizza' => $result[0]
            ]);
        }
     
        
        $result = $PizzaModel->offer();


        return $this->render('order', [
    
            'pizzas' => $result['data']
        ]);
    }

    public function checkout(Request $request)
    {
        $this->setLayout('main');
        return $this->render('checkout');
    }

   

    public function viewProduct(Request $request)
    {
        
        return $this->render('meal');
    }

    public function account()
    {
        $this->setLayout('main');
        return $this->render('account');
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




