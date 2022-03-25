<?php
use Phalcon\Mvc\Controller;

class TestController extends Controller
{
    public function indexAction()
    {
        $helper=new \App\Components\Helper();
        // var_dump($helper);
        echo $helper->testComponents();
    }
}
