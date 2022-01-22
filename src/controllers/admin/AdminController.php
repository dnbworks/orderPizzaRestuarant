<?php

declare(strict_types = 1);

namespace app\controllers\admin;

use app\core\Controller;
use app\core\Request;
use app\core\Application;
use app\core\Response;

class AdminController extends Controller
{
    /**
     * Get the contents of a view template using the native framework template
     * engine.
     *
     * @param Request $request
     * @param Response $response
     * @return mixed
     * 
     */
    public function login(Request $request, Response $response) : mixed
    {
        if(!Application::IsGuest()){
            $response->redirect('/dashboard');
            return null;
        } 

        $this->setLayout('admin');
        return $this->render('admin/login');
    }
}