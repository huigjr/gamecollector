<?php

abstract class BaseController
{

    protected $di;
    protected $slug;
    protected $session;
    protected $accesslevel = 0;
    protected $view = 'default.html';
    protected $template = 'default';

    public function __construct($di, $slug)
    {
        $this->di = $di;
        $this->slug = $slug;
		$this->session = $di->Session;
        $this->init();
        $di->Security->authorize($this->accesslevel);
    }

    protected function init(){}

    public function getPage()
    {
        $this->di->Page->setTemplate($this->template, $this->view);
        return $this->di->Page;
    }
}