<?php

class LoginController extends BaseController
{
    protected $view = 'login.html';

    public function init()
    {
        if(!empty($_POST['username']) && !empty($_POST['password'])){
            $this->di->Security->authenticate($_POST['username'], $_POST['password']);
        }
    }
}