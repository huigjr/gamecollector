<?php

class Template
{

    protected $template;
    protected $variables = array();

    public function __construct($template, $array = null)
    {
        $this->template = $template;
        if($array) foreach($array as $key => $value) $this->variables[$key] = $value;
    }

    public function __set($key, $value)
    {
        $this->variables[$key] = $value;
    }
    
    public function get()
    {
        extract($this->variables);
        ob_start();
        include($this->template);
        return ob_get_clean();
    }

    public function __toString()
    {
        return $this->get();
    }
}