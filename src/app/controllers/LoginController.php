<?php

use Phalcon\Mvc\Controller;

class LoginController extends Controller
{
    public function indexAction()
    {
        if ($this->cookies->has('rememberMe')) {
            $this->response->redirect('dashboard');
        }
        if ($this->request->hasPost('email') && $this->request->hasPost('password')) {
            $user=Users::findFirst(
                [
                    'email = :email: AND password = :password:',
                    'bind' => [
                        'email' => $this->request->getPost('email'),
                        'password' => $this->request->getPost('password'),
                    ],
                ]
            );
            
            if ($user) {
                $this->session->set('id', $user->id);
                $this->session->set('name', $user->name);
                $this->flash->success($this->session->name);
                $this->response->redirect('dashboard');
                if ($this->request->getPost('remember')==='on') {
                    $this->cookies->set('rememberMe', $user->id, time() + 15*36000);
                    $this->cookies->send();
                }
            } else {
                $this->response->setStatusCode(403, 'Wrong Credentials')
                                ->setContent("Authentication failed!, wrong credentials");
            }
            
        } else {
            $this->view->message='input Field should not be empty';
        }
    }
    public function logoutAction()
    {
        $this->session->destroy();
        $this->cookies->get('rememberMe')->delete();
        $this->response->redirect('login');
    }
}
