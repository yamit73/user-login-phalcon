<?php
use Phalcon\Mvc\Controller;

class HackerController extends Controller
{
    public function indexAction()
    {
        $hack=new Hack();
        $hack->name=$this->escaper->escapeHtml($this->request->getPost('name'));
        $hack->script=$this->escaper->escapeHtml($this->request->getPost('script'));
        if ($hack->save()) {
            $this->response->redirect('/');
        }
    }
}
