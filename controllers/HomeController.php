<?php

class HomeController extends BaseController
{
    protected $view = 'home.html';

    public function init()
    {
        $this->di->PageModel->read(1);
        $this->di->GameModel->getHome();
    }
}