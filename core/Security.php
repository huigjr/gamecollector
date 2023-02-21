<?php

class Security
{

    private $di;
    private $session;

    public function __construct($di)
    {
        $this->di = $di;
        $this->session = $di->Session;
    }
    
    public function authenticate($username, $password)
    {
        if($username === 'admin' && $password === 'admin'){
            $this->session->userlevel = 2;
            RedirectHelper::redirect('/admin');
        } elseif($username === 'demo' && $password === 'demo'){
            $this->session->userlevel = 1;
            RedirectHelper::redirect('/dashboard');
        } else $this->session->error = 'Username/Password combination incorrect';
    }

    public function authorize($accesslevel)
    {
        If($accesslevel <= $this->session->userlevel) return true;
        elseif($this->session->userlevel > 0) RedirectHelper::forbidden();
        else RedirectHelper::redirect('/login');
    }
}