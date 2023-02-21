<?php

class GamesController extends BaseController
{
    protected $view = 'detail.html';

    public function init()
    {
        if(count($this->slug) === 1)$this->di->GameModel->getDetail($this->slug[0]);
        else RedirectHelper::pageNotFound();
    }
}