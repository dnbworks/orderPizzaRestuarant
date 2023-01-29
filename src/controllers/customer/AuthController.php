<?php

namespace app\controllers\customer;

use app\core\Controller;
use app\core\Request;
use app\models\LoginModel;
use app\models\CustomerModel;
use app\core\Application;
use app\core\Response;

class AuthController extends Controller
{
    public function login(Request $request, Response $response)
    {
        if(!Application::IsGuest()){
            $response->redirect('/my-account');
            return;
        } 

        $this->setLayout('Auth');
        $loginModel = new LoginModel(); 
  
        return $this->render('login', ["model" => $loginModel]);
    }

    public function store(Request $request, Response $response) 
    {
        $loginModel = new LoginModel(); 
        
        if($request->isPost()){
          
            $loginModel->loadData($request->getBody());
           
            if($loginModel->validate() && $loginModel->signIn()){
                // if(isset($_SESSION['url'])){
                //     $response->redirect('/checkout');
                //     return;
                // }
                       
               
                $response->redirect('/my-account');
                return;
            }
            
            return $this->render('login', ["model" => $loginModel]);
        }
    }

    public function register(Request $request, Response $response)
    {   
        // if user is already logged in redirect user to dashboard
        if(!Application::IsGuest()){
            $response->redirect('/dashboard');
            exit;
        } 
        $this->setLayout('main');
        $registerModel = new CustomerModel();
        if($request->isPost()){
            $registerModel->loadData($request->getBody());
           
            if($registerModel->validate() && $registerModel->register()){
                Application::$app->session->setFlash("success", "thank you for signing up. Your account has been created. You can login now");
                Application::$app->response->redirect("/login");
            }

            return $this->render('register', ["model" => $registerModel]);
        }
        return $this->render('register', ["model" => $registerModel]);
    }

    public function logout(Request $request, Response $response)
    {   
        if($request->isPost()){
            Application::$app->logout();
            $response->redirect('/');
        }
    }
}

