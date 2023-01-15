<?php

class Navigation
{
    private $di;
    private $session;

    public function __construct($di)
    {
        $this->di = $di;
        $this->session = $di->Session;
    }

    public function get()
    {
        if($this->session->userlevel === 0) return $this->getFrontMenu();
        else return $this->getAdminMenu($this->session->userlevel);
    }
    
    private function getAdminMenu($userlevel)
    {
        $output = '<a href="/admin">Home</a>'.PHP_EOL;
        foreach(AdminController::MODELS as $key => $value){
            $output .= '<a href="/admin/'.$key.'">'.ucfirst($key).'</a>'.PHP_EOL;
        }
        return $output;
    }
    
    private function getFrontMenu()
    {
        return null;
    }
}