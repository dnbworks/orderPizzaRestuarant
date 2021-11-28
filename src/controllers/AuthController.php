<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;
use app\models\LoginModel;
use app\models\UserModel;
use app\core\Application;
use app\core\Response;

class AuthController extends Controller
{
    public function login(Request $request, Response $response)
    {
        // if user is already logged in redirect user to dashboard
        if(!Application::IsGuest()){
            $response->redirect('/my-account');
            exit;
        } 

        $this->setLayout('Auth');

        $loginModel = new LoginModel();
        if($request->isPost()){
            $loginModel->loadData($request->getBody());

            if($loginModel->validate() && $loginModel->signIn()){
                if(isset($_SESSION['url'])){
                    $response->redirect('/checkout');
                    return;
                }
                $response->redirect('/my-account');
                return;
            }

            return $this->render('login', ["model" => $loginModel]);
        }

        return $this->render('login', ["model" => $loginModel]);
    }

    public function register(Request $request, Response $response)
    {   
        // if user is already logged in redirect user to dashboard
        if(!Application::IsGuest()){
            $response->redirect('/dashboard');
            exit;
        } 
        $this->setLayout('main');

        $registerModel = new UserModel();
        if($request->isPost()){
           
            $registerModel->loadData($request->getBody());
           
            if($registerModel->validate() && $registerModel->register())
            {
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

