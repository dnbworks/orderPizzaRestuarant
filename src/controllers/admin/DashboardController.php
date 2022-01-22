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



class DashboardController extends Controller 
{
    public function __construct()
    {
        // add middleware to certain pages
        $this->registerMiddleware(new AuthMiddleware(['edit', 'dashboard', 'profile']));
    }
    public function dashboard(Request $request, Response $response)
    {
        $this->setLayout('main');
        return $this->render('dashboard');
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
}