<?php

class HomeController extends BaseController
{
    protected $view = 'home.html';

    public function init()
    {
        $this->di->GameModel->getHome();
        $this->di->PageModel->read(1);
    }
}