<?php
use Phalcon\Mvc\Controller;

class UserController extends Controller
{
    public function indexAction()
    {
        $this->view->postdata=$this->request->isPost();
        if ($this->request->isPost()) {
            $user=new Users();
            $user->assign(
                $this->request->getPost(),
                [
                    'name',
                    'email',
                    'password'
                ]
            );
            if ($user->save()) {
                $this->view->message="User created";
            } else {
                $this->view->message="Not created: <br>".implode("<br>", $user->getMessages());
            }
        }
    }
}
