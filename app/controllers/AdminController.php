<?php
declare(strict_types=1);

class AdminController extends ControllerBase
{

    public function beforeExecuteRoute()
    {
        $auth = $this->session->get('auth');
        if (empty($auth)) {
            $this->flashSession->error('You must be logged in');
            $this->response->redirect(['for' => 'loginForm']);

            return false;
        }
    }

    public function indexAction()
    {

    }

}

