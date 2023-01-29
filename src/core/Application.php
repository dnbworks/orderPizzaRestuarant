<?php

namespace app\core;

use app\models\UserModel;
use app\core\View;

class Application {

    public Router $router;
    public Request $request;
    public Response $response;
    public Render $render;
    public string $userClass;
    public static Application $app;
    public ?Controller $controller = null;
    public static string $ROOT_DIR;
    public Database $db;
    public Session $session;
    public ?UserModel $user;
    public View $view;
    public string $layout = 'error';

    public function __construct($rootPath, array $config)
    {
        self::$ROOT_DIR = $rootPath;
        $this->userClass = $config['userClass'];
        self::$app = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
        $this->db = new Database($config['db']);
        $this->session = new Session();
        $this->view = new View();
        $this->render = new Render();

        $userId = Application::$app->session->get('user');
        if ($userId) {
            $key = $this->userClass::primaryKey();
            $this->user = $this->userClass::findOne([$key => $userId]);
        } else {
            $this->user = NULL;
        }
    }

    public function login(UserModel $user){
        $this->user = $user;
        $primaryKey = $user::primaryKey();
        $value = $user->{$primaryKey};
        Application::$app->session->set('user', $value);

        return true;
    }

    public function logout()
    {
        $this->user = null;
        $this->session->remove('user');
    }

    public static function IsGuest()
    {
        return !self::$app->user;
    }

    public function run()
    {
        try{
            echo $this->router->resolve();
        }catch(\Exception $e){
            $this->response->setStatusCode($e->getCode());
           
            echo $this->view->renderView('_error', [
                'exception' => $e,
            ]);
            
        }
    }
}