<?php

class ConsolesController extends BaseController
{
    protected $view = 'consolegames.html';

    public function init()
    {
        if(count($this->slug) === 1)$this->di->GameModel->getGamesByConsole($this->slug[0]);
        else RedirectHelper::pageNotFound();
    }
}