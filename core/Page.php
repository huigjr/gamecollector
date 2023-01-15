<?php

class Page
{

    public $navigation = '';
    public $notification = '';
    
    private $di;
    private $session;
    private $template;

    public function __construct($di)
    {
        $this->di = $di;
        $this->session = $di->Session;
        $this->checkNotification();
        $this->navigation = $di->Navigation->get();
        $this->setTemplate('default', 'default.html');
    }
    
    public function setTemplate($directory, $file)
    {
        $this->template  = ROOT . "/views/$directory/$file";
    }
    
    public function __toString()
    {
        extract((array)$this);
        ob_start();
        include($this->template);
        return ob_get_clean();
    }

    public function fill($array)
    {
        if(empty($array)) RedirectHelper::pageNotFound();
        foreach($array as $key => $value) $this->$key = $value;
    }
    
    public function partial($name, $query)
    {
        $db = $this->di->DB;
        $this->$name = function() use ($db, $query){
            foreach($db->generate($query) as $row) yield $row;
        };
    }

    private function checkNotification(){
        if($message = $this->session->message){
            $this->notification = '<div class="popup message"><p>'.$message.'</p></div>';
            $this->session->remove('message');
        }
        if($error = $this->session->error){
            $this->notification = '<div class="popup error"><p>'.$error.'</p></div>';
            $this->session->remove('error');
        }
    }
}