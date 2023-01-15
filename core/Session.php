<?php

class Session
{

	public $history;

    public function __construct()
    {
        $_SESSION['history'] = $_SERVER['REQUEST_URI'];
        foreach($_SESSION as $key => $value) $this->$key = $value;
    }

    public function __set($key, $value)
    {
        $_SESSION[$key] = $this->$key = $value;
    }
    
    public function __get($key)
    {
        if($key === 'userlevel') return $_SESSION['userlevel'] ?? 0;
        else return $this->$key ?? null;
    }
    
    public function remove($key)
    {
        unset($this->$key);
        unset($_SESSION[$key]);
    }
}