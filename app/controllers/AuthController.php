<?php
declare(strict_types=1);

use App\Validations\RegisterFormValidator;
use Phalcon\Security;

class AuthController extends \Phalcon\Mvc\Controller
{
    public function initialize()
    {
        $cssClasses = [
            'error'   => 'alert alert-danger',
            'success' => 'alert alert-success',
            'notice'  => 'alert alert-info',
            'warning' => 'alert alert-warning',
        ];

        $this->flashSession->setCssClasses($cssClasses);

        $this->view->old = json_decode($this->session->get('old', "{}", true));

        if ($this->request->isPost() && ! $this->security->checkToken()) {
            throw new Error("Wrong CSRF token");

        }
    }

    public function loginFormAction()
    {

    }

    public function registerFormAction()
    {

    }

    public function registerAction()
    {
        $validation = new RegisterFormValidator();

        $messages = $validation->validate($_POST);
        if (count($messages) > 0) {
            $this->withFlashErrorMessages($messages);
            $this->session->set('old', json_encode($_POST));

            return $this->response->redirect(['for' => 'registerForm']);
        }
        else {
            $user = new Users();
            $user->first_name = $this->request->get('firstName', 'alpha');
            $user->last_name = $this->request->get('lastName', 'alpha');
            $user->age = $this->request->get('age', 'int');
            $user->phone = $this->request->get('phone', 'int');
            $user->drivers_licence_number = $this->request->get('licenseNumber', 'string');
            $user->password = $this->security->hash($this->request->get('password', 'string'));
            $user->address = $this->request->get('address', 'string');

            $result = $user->save();
            if (false === $result) {
                $this->flashSession->error("Something went wrong");

                return $this->response->redirect(['for' => 'registerForm']);
            }

            $this->flashSession->success("You have successfully registered. Now you can log in!");

            return $this->response->redirect(['for' => 'loginForm']);
        }
    }

    protected function withFlashErrorMessages($messages)
    {
        foreach ($messages as $message)
            $this->flashSession->error($message->getMessage());
    }

    public function checkLoginAction()
    {
        $licenseNumber = $this->request->get('licenseNumber', 'string');
        $password = $this->request->get('password', 'string');
        $this->session->set('old', json_encode(['licenseNumber' => $_POST['licenseNumber']]));

        $user = Users::findFirst(['drivers_licence_number = :license:', 'bind' => ['license' => $licenseNumber]]);
        if (! empty($user) && $this->security->checkHash($password, $user->password)) {
            $this->registerSession($user);
            $this->response->redirect(['for' => 'admin']);
        }
        else {
            $this->flashSession->error("Wrong credentials");

            return $this->response->redirect(['for' => 'loginForm']);
        }
    }

    private function registerSession($user)
    {
        $this->session->set('auth', [
            'id'        => $user->id,
            'firstName' => $user->first_name,
            'lastName'  => $user->last_name,
            'role'      => 'user',
        ]);
    }

    public function logOutAction()
    {
        $this->session->remove('auth');
        $this->flashSession->success("You have successfully logged out!");

        return $this->response->redirect(['for' => 'loginForm']);
    }
}

